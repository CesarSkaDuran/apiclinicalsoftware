<?php

namespace App\Http\Controllers;

use App\RipsProviderConfig;
use App\RipsReport;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RipsController extends Controller
{
    public function providerConfig(Request $request)
    {
        $config = RipsProviderConfig::where('owner_user_id', $request->user()->id)->first();

        return response()->json([
            'numDocumentoIdObligado' => $config ? $config->num_documento_id_obligado : null,
            'nextNumNota' => $config ? (string) $config->next_num_nota : '1',
            'codPrestador' => $config ? $config->cod_prestador : null,
        ]);
    }

    public function saveProviderConfig(Request $request)
    {
        $data = $request->validate([
            'numDocumentoIdObligado' => ['required', 'string', 'max:12'],
            'codPrestador' => ['nullable', 'string', 'max:12'],
        ]);

        try {
            $config = DB::transaction(function () use ($request, $data) {
                $config = RipsProviderConfig::where('owner_user_id', $request->user()->id)
                    ->lockForUpdate()
                    ->first();

                $otherOwnerUsesObligado = RipsProviderConfig::where('num_documento_id_obligado', $data['numDocumentoIdObligado'])
                    ->where('owner_user_id', '!=', $request->user()->id)
                    ->exists();

                if ($otherOwnerUsesObligado) {
                    abort(409, 'Este obligado ya está configurado en otra cuenta. Usa una sola cuenta por prestador.');
                }

                if ($config && $config->num_documento_id_obligado !== $data['numDocumentoIdObligado']) {
                    $hasReports = RipsReport::where('owner_user_id', $request->user()->id)->exists();

                    if ($hasReports) {
                        abort(409, 'El documento del obligado no se puede cambiar después de generar reportes.');
                    }
                }

                if (!$config) {
                    $config = new RipsProviderConfig();
                    $config->owner_user_id = $request->user()->id;
                    $config->next_num_nota = 1;
                }

                $config->num_documento_id_obligado = $data['numDocumentoIdObligado'];
                $config->cod_prestador = $data['codPrestador'] ?? null;
                $config->save();

                return $config;
            });
        } catch (QueryException $exception) {
            $existingConfig = RipsProviderConfig::where('num_documento_id_obligado', $data['numDocumentoIdObligado'])->first();

            if ((string) $exception->getCode() === '23000' && $existingConfig) {
                if ((int) $existingConfig->owner_user_id !== (int) $request->user()->id) {
                    abort(409, 'Este obligado ya está configurado en otra cuenta. Usa una sola cuenta por prestador.');
                }

                $config = $existingConfig;
            } else {
                throw $exception;
            }
        }

        return response()->json([
            'numDocumentoIdObligado' => $config->num_documento_id_obligado,
            'codPrestador' => $config->cod_prestador,
            'nextNumNota' => (string) $config->next_num_nota,
        ]);
    }

    public function storeReport(Request $request)
    {
        $rules = [
            'payload' => ['required', 'array'],
            'payload.tipoNota' => ['required', 'in:RS'],
            'payload.usuarios' => ['required', 'array', 'min:1', 'max:500'],
            'payload.usuarios.*' => ['required', 'array'],
            'payload.usuarios.*.tipoDocumentoIdentificacion' => ['required', 'string'],
            'payload.usuarios.*.numDocumentoIdentificacion' => ['required', 'string'],
            'payload.usuarios.*.tipoUsuario' => ['required', 'string'],
            'payload.usuarios.*.fechaNacimiento' => ['required', 'string'],
            'payload.usuarios.*.codSexo' => ['required', 'string'],
            'payload.usuarios.*.codPaisResidencia' => ['required', 'string'],
            'payload.usuarios.*.codMunicipioResidencia' => ['required', 'string'],
            'payload.usuarios.*.codZonaTerritorialResidencia' => ['required', 'string'],
            'payload.usuarios.*.incapacidad' => ['required', 'string'],
            'payload.usuarios.*.codPaisOrigen' => ['required', 'string'],
            'payload.usuarios.*.consecutivo' => ['required', 'integer', 'min:1'],
            'payload.usuarios.*.servicios' => ['required', 'array'],
            'payload.usuarios.*.servicios.consultas' => ['required', 'array'],
            'payload.usuarios.*.servicios.procedimientos' => ['required', 'array'],
            'payload.usuarios.*.servicios.consultas.*' => ['required', 'array'],
            'payload.usuarios.*.servicios.procedimientos.*' => ['required', 'array'],
        ];
        $commonServiceRules = [
            'codPrestador' => ['required', 'string'],
            'fechaInicioAtencion' => ['required', 'string'],
            'modalidadGrupoServicioTecSal' => ['required', 'string'],
            'grupoServicios' => ['required', 'string'],
            'codServicio' => ['required', 'numeric'],
            'finalidadTecnologiaSalud' => ['required', 'string'],
            'tipoDocumentoIdentificacion' => ['required', 'string'],
            'numDocumentoIdentificacion' => ['required', 'string'],
            'codDiagnosticoPrincipal' => ['required', 'string'],
            'vrServicio' => ['required', 'numeric', 'min:0'],
            'conceptoRecaudo' => ['required', 'string'],
            'valorPagoModerador' => ['required', 'numeric', 'min:0'],
            'consecutivo' => ['required', 'integer', 'min:1'],
        ];

        foreach (['consultas' => 'codConsulta', 'procedimientos' => 'codProcedimiento'] as $group => $codeField) {
            $servicePrefix = 'payload.usuarios.*.servicios.' . $group . '.*.';
            $rules[$servicePrefix . $codeField] = ['required', 'string'];

            foreach ($commonServiceRules as $field => $fieldRules) {
                $rules[$servicePrefix . $field] = $fieldRules;
            }
        }

        $rules['payload.usuarios.*.servicios.consultas.*.causaMotivoAtencion'] = ['required', 'string'];
        $rules['payload.usuarios.*.servicios.consultas.*.tipoDiagnosticoPrincipal'] = ['required', 'string'];
        $rules['payload.usuarios.*.servicios.procedimientos.*.viaIngresoServicioSalud'] = ['required', 'string'];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $request->input('payload');
        $payload['numFactura'] = null;

        foreach ($payload['usuarios'] as $user) {
            $services = isset($user['servicios']) && is_array($user['servicios'])
                ? $user['servicios']
                : null;

            if (!$services || !isset($services['consultas'], $services['procedimientos']) ||
                !is_array($services['consultas']) || !is_array($services['procedimientos']) ||
                count($services['consultas']) + count($services['procedimientos']) === 0) {
                return response()->json(['message' => 'Cada usuario debe tener al menos un servicio válido.'], 422);
            }
        }

        $encodedPayload = json_encode($payload);

        if ($encodedPayload === false || strlen($encodedPayload) > 5 * 1024 * 1024) {
            return response()->json(['message' => 'El reporte excede el tamaño permitido.'], 413);
        }

        $result = DB::transaction(function () use ($request, $payload) {
            $config = RipsProviderConfig::where('owner_user_id', $request->user()->id)
                ->lockForUpdate()
                ->first();

            if (!$config) {
                abort(409, 'Guarda primero la configuración del obligado.');
            }

            $numNota = (string) $config->next_num_nota;
            $config->next_num_nota++;
            $config->save();

            $payload['numDocumentoIdObligado'] = $config->num_documento_id_obligado;
            $payload['numFactura'] = null;
            $payload['tipoNota'] = 'RS';
            $payload['numNota'] = $numNota;

            $report = RipsReport::create([
                'owner_user_id' => $request->user()->id,
                'num_documento_id_obligado' => $config->num_documento_id_obligado,
                'num_nota' => $numNota,
                'payload' => Crypt::encrypt(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)),
            ]);

            return [
                'report' => $report,
                'nextNumNota' => (string) $config->next_num_nota,
            ];
        });

        return response()->json([
            'id' => $result['report']->id,
            'numNota' => $result['report']->num_nota,
            'nextNumNota' => $result['nextNumNota'],
            'payload' => json_decode(Crypt::decrypt($result['report']->payload), true),
        ], 201);
    }

    public function reports(Request $request)
    {
        $reports = RipsReport::where('owner_user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get(['id', 'num_documento_id_obligado', 'num_nota', 'created_at']);

        return response()->json($reports->map(function ($report) {
            return [
                'id' => $report->id,
                'numDocumentoIdObligado' => $report->num_documento_id_obligado,
                'numNota' => $report->num_nota,
                'createdAt' => $report->created_at->toIso8601String(),
            ];
        }));
    }

    public function showReport(Request $request, $id)
    {
        $report = RipsReport::where('owner_user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'id' => $report->id,
            'numNota' => $report->num_nota,
            'payload' => json_decode(Crypt::decrypt($report->payload), true),
        ]);
    }
}
