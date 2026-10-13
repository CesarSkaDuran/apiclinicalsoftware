<?php
namespace App\Http\Controllers;

ini_set('max_execution_time', 300);


use Carbon\Carbon;
use Illuminate\Http\Request;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Patient;
use App\Record;
use App\RecordDetail;
use App\RecordPhysical;
use App\Citology;
use App\Pregnancy;
use App\Conclusion;
use App\Control;
use App\Obs;
use App\Evolution;
use App\Income;
use App\Appointment;

class ToolsController extends Controller
{
    public function import()
    {
        return view('import');
    }

    public function importPatients(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $patients = [];
        
        foreach ($collection as $value) {
            $patient = [
                'user_id' => 1,
                'name' => $value['NOMBRE'],
                'identification' => $value['HISTORIA'],
                'position' => $value['PROFESION'],
                'civil_status' => $this->getECId($value['EC']),
                'birth_date' => $value['FECHANAC'] ? (!is_string($value['FECHANAC']) ? $value['FECHANAC']->format('Y-m-d') : NULL) : NULL,
                'phone' => $value['TELEFONO'],
                'address' => $value['DIRECCIONE'],
                'company' => $value['EMPRESA'],
                'partner_name' => $value['ESPOSO'],
                'partner_profession' => $value['PROFESIO'],
                'created_at' => $value['INGRESO'] ? (!is_string($value['INGRESO']) ? $value['INGRESO']->format('Y-m-d') : NULL) : NULL,
            ];

            array_push($patients, $patient);
        }

        Patient::insert($patients);

        return back()->with('success', 'Pacientes importados correctamente');
    }

    public function importRecords(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;

        $collection = (new FastExcel)->import($path);
        $records = [];
        $details = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }
            
            $record = [
                'patient_id' => $value['HISTORIA'],
                'user_id' => 1,
                'identification' => $value['HISTORIA'],
                'created_at' => $value['FECHA'] ? (!is_string($value['FECHA']) ? $value['FECHA']->format('Y-m-d') : NULL) : NULL,
            ];

            $detail = [
                'record_id' => $value['HISTORIA'],
                'motive' => $value['MOTIVO1'] . '<br>' . $value['MOTIVO2'] . '<br>' . $value['MOTIVO3'],
                'menarche' => '',
                'cycles' => $value['CICLOS'],
                'cycle_p' => $value['CICLOP'],
                'cycle_m' => $value['CICLOM'],
                'record_fur' => $value['FUR'],
                'record_g' => $value['G'],
                'record_p' => $value['P'],
                'record_v' => $value['U'],
                'record_s' => $value['S'],
                'record_a' => '',
                'record_pp' => $value['PP'],
                'record_up' => $value['UP'],
                'record_prs' => $value['PRS'],
                'record_fpp' => $value['FPP'],
                'amenorrhea' => $value['AMENORREA'],
                'menorrhea' => $value['MENORREA'],
            ];

            array_push($records, $record);
            array_push($details, $detail);
        }

        foreach (array_chunk($records, 1000) as $r) {
            Record::insert($r);
        }

        foreach (array_chunk($details, 1000) as $d) {
            RecordDetail::insert($d);
        }
        
        return back()->with('success', 'Historias importadas correctamente');
    }

    public function importPhysical(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $physicals = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }

            $physical = [
                'record_id' => $value['HISTORIA'],
                'physical_ta' => $value['TA'],
                'physical_fc' => $value['FC'],
                'weight' => $value['PESO'],
                'height' => $value['ESTATURA'],
                'head' => $value['CABEZA'],
                'neck' => $value['CUELLO'],
                'thorax' => $value['TORAX'],
                'pregnancy' => strtolower($value['EMBA']) == 's' || strtolower($value['EMBA']) == '1' ? 1 : 0,
                'abd' => strtolower($value['ABDOMEN']) == 's' || strtolower($value['ABDOMEN']) == '1' ? 1 : 0,
            ];

            array_push($physicals, $physical);
        }

        foreach (array_chunk($physicals, 1000) as $p) {
            RecordPhysical::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }

    public function importCito(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $citologies = [];
        $pregnancies = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }

            if ($value['ULTICITO'] || $value['RESULCITO']) {
                $citology = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['ULTICITO'] ? (!is_string($value['ULTICITO']) ? $value['ULTICITO']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['RESULCITO'],
                ];

                array_push($citologies, $citology);
            }
            
            if ($value['FECH1']) {
                $preg1 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH1'] ? (!is_string($value['FECH1']) ? $value['FECH1']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA1'],
                ];
                
                array_push($pregnancies, $preg1);
            }

            if ($value['FECH2']) {
                $preg2 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH2'] ? (!is_string($value['FECH2']) ? $value['FECH2']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA2'],
                ];
                
                array_push($pregnancies, $preg2);
            }

            if ($value['FECH3']) {
                $preg3 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH3'] ? (!is_string($value['FECH3']) ? $value['FECH3']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA3'],
                ];
                
                array_push($pregnancies, $preg3);
            }

            if ($value['FECH4']) {
                $preg4 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH4'] ? (!is_string($value['FECH4']) ? $value['FECH4']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA4'],
                ];
                
                array_push($pregnancies, $preg4);
            }

            if ($value['FECH5']) {
                $preg5 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH5'] ? (!is_string($value['FECH5']) ? $value['FECH5']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA5'],
                ];
                
                array_push($pregnancies, $preg5);
            }

            if ($value['FECH6']) {
                $preg6 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH6'] ? (!is_string($value['FECH6']) ? $value['FECH6']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA6'],
                ];
                
                array_push($pregnancies, $preg6);
            }

            if ($value['FECH7']) {
                $preg7 = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECH7'] ? (!is_string($value['FECH7']) ? $value['FECH7']->format('Y-m-d') : NULL) : NULL,
                    'description' => $value['EMBA7'],
                ];
                
                array_push($pregnancies, $preg7);
            }

        }

        foreach (array_chunk($citologies, 1000) as $p) {
            Citology::insert($p);
        }

        foreach (array_chunk($pregnancies, 1000) as $p) {
            Pregnancy::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }

    public function importControls(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $controls = [];
        $observations = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }

            for ($i=1; $i < 9; $i++) {
                $control = [
                    'record_id' => $value['HISTORIA'],
                    'date' => $value['FECHA'.$i],
                    'weight' => $value['PESO'.$i],
                    'week' => $value['SEM'.$i],
                    'control_t' => $value['TA'.$i.'A'] . ':' . $value['TA'.$i.'B'],
                    'control_a' => $value['AU'.$i],
                    'control_pam' => $value['PAM'.$i],
                    'control_au' => $value['AU'.$i],
                    'pression' => $value['PRES'.$i],
                    'fcf' => $value['RF'.$i],
                    'edema' => $value['EDEMA'.$i],
                ];

                array_push($controls, $control);
            }

            $observation = [
                'record_id' => $value['HISTORIA'],
                'description' => $this->validateStr($value['OBSER1']) . $this->validateStr($value['OBSER2']) . $this->validateStr($value['OBSER3']) . $this->validateStr($value['OBSER4']) . $this->validateStr($value['OBSER5']) . $this->validateStr($value['OBSER6']) . $this->validateStr($value['OBSER7']) . $this->validateStr($value['OBSER8']) . $this->validateStr($value['OBSER9']) . $this->validateStr($value['OBSER10'])
            ];

            array_push($observations, $observation);
        }

        foreach (array_chunk($controls, 1000) as $p) {
            Control::insert($p);
        }

        foreach (array_chunk($observations, 1000) as $p) {
            Obs::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }

    public function importConclusions(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;

        $collection = (new FastExcel)->import($path);
        $conclusions = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }

            $conclusion = [
                'record_id' => $value['HISTORIA'],
                'surgical' => $this->validateStr($value['QUIRUR1']) . $this->validateStr($value['QUIRUR2']) . $this->validateStr($value['QUIRUR3']),
                'pathological' => $this->validateStr($value['PATOL1']) . $this->validateStr($value['PATOL2']),
                'notes' => $this->validateStr($value['NOTA1']) . $this->validateStr($value['NOTA2']),
                'diagnosis' => $this->validateStr($value['DIAGNOS1']) . $this->validateStr($value['DIAGNOS2']) . $this->validateStr($value['DIAGNOS3']) . $this->validateStr($value['DIAGNOS4']) . $this->validateStr($value['DIAGNOS5']),
                'tests' => $this->validateStr($value['EXAMEN1']) . $this->validateStr($value['EXAMEN2']),
                'behavior' => $this->validateStr($value['CONDUCTA1']) . $this->validateStr($value['CONDUCTA2']) . $this->validateStr($value['CONDUCTA3']) . $this->validateStr($value['CONDUCTA4']) . $this->validateStr($value['CONDUCTA5']),
                'process' => $this->validateStr($value['PROCEDI1']) . $this->validateStr($value['PROCEDI2']) . $this->validateStr($value['PROCEDI3']) . $this->validateStr($value['PROCEDI4']) . $this->validateStr($value['PROCEDI5']),
                'noem' => $this->validateStr($value['NOEM1']) . $this->validateStr($value['NOEM2']) . $this->validateStr($value['NOEM3']) . $this->validateStr($value['NOEM4']) . $this->validateStr($value['NOEM5']) . $this->validateStr($value['NOEM6']) . $this->validateStr($value['NOEM7']) . $this->validateStr($value['NOEM8']) . $this->validateStr($value['NOEM9']),
                'gino' => $this->validateStr($value['GINO1']) . $this->validateStr($value['GINO2']) . $this->validateStr($value['GINO3']) . $this->validateStr($value['GINO4']) . $this->validateStr($value['GINO5']) . $this->validateStr($value['GINO6']) . $this->validateStr($value['GINO7']) . $this->validateStr($value['GINO8']) . $this->validateStr($value['GINO9']),
            ];

            array_push($conclusions, $conclusion);
        }

        foreach (array_chunk($conclusions, 1000) as $r) {
            Conclusion::insert($r);
        }
        
        return back()->with('success', 'importadado correctamente');
    }

    public function importEvolutions(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $evolutions = [];
        
        foreach ($collection as $value) {
            if (!$value['HISTORIA'] || $value['HISTORIA'] == '') {
                continue;
            }

            $evolution = [
                'record_id' => $value['HISTORIA'],
                'date' => $value['FECHA'] ? (!is_string($value['FECHA']) ? $value['FECHA']->format('Y-m-d') : NULL) : NULL,
                'details' => $this->validateStr($value['OBSER1']) . $this->validateStr($value['OBSER2']) . $this->validateStr($value['OBSER3']) . $this->validateStr($value['OBSER4']) . $this->validateStr($value['OBSER5']) . $this->validateStr($value['OBSER6']),
            ];

            array_push($evolutions, $evolution);

        }

        foreach (array_chunk($evolutions, 1000) as $p) {
            Evolution::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }
    
    public function importIncomes(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $incomes = [];
        
        foreach ($collection as $value) {
            $income = [
                'user_id' => 1,
                'date' => $value['FECHA'] ? (!is_string($value['FECHA']) ? $value['FECHA']->format('Y-m-d') : NULL) : NULL,
                'concept' => $value['CONCEPTO'],
                'value' => $value['VALOR'],
            ];

            array_push($incomes, $income);

        }

        foreach (array_chunk($incomes, 1000) as $p) {
            Income::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }
    
    public function importAppointments(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/import_files/', $name);
        $path = public_path() . '/import_files/' . $name;
        // $path = $request->file('file')->getRealPath();

        $collection = (new FastExcel)->import($path);
        $appointments = [];
        
        foreach ($collection as $value) {
            $appointment = [
                'user_id' => 1,
                'date' => $value['FECHA'] ? (!is_string($value['FECHA']) ? $value['FECHA']->format('Y-m-d') : NULL) : NULL,
                'name' => $value['PACIENTE'],
                'company' => $value['EMPRESA'],
                'value' => $value['VALOR'],
                'time' => $value['HORA'],
            ];

            array_push($appointments, $appointment);

        }

        foreach (array_chunk($appointments, 1000) as $p) {
            Appointment::insert($p);
        }

        return back()->with('success', 'Importado correctamente');
    }

    private function getECId($ecString)
    {
        $EC_ARRAY = [
            "CASADA" => 2,
            "U.L." => 3,
            "SOLTERA" => 1,
            "SEPARADA" => 6,
            "CASADADA" => 2,
            "" => 6,
            "VIUDA" => 5,
            "U. L." => 3,
            "CASADA PRIMO" => 2,
            "CASADA  ." => 2,
            "CASADAA" => 2,
            "VIUDAA" => 5,
            "U L." => 3,
            "VIUDA(DARIO)" => 5,
            "UNION LIBRE" => 3,
            "U.  L." => 3,
            "SOLTERA." => 1,
            "CASAD" => 2,
            "VIUDAviuda" => 5,
            ".ASADA" => 2,
            "SOLTA" => 1,
            "U. .L" => 3,
            "POLICIA" => 6,
            "CASAD HOGAR" => 2,
            "SEPARAD" => 6,
            "DIVORCIADA" => 4,
            "AHOGAR" => 6,
            "ESTUDIANTE" => 6,
            "VASADA" => 2,
            "SOLTAREA" => 1,
            "CASADAÇ" => 2,
            "SLTERA" => 1,
            "CSOLTERA" => 1,
            "PENSIONADA" => 6,
            "ESTUDIENTE" => 6,
            "SOLTERA EMPLE" => 1,
            "ACASADA" => 2,
            "CAASADA" => 2,
            "ESTIDIANTE" => 6,
            "SOLTERA HOGAR" => 1,
            "U.L" => 3,
            "U. L" => 3,
            "CADSADA" => 2,
            "UL" => 3,
            "CADADA" => 2,
            "EMPLEADA SEPA" => 6,
            "A CASAD" => 2,
            "U.L HOGAR" => 3,
            "ESTILISTA" => 6,
            "ESOLTERA" => 1,
            "CASAA" => 2,
            "OMATICA." => 6,
            "FUE IMPOSI" => 6,
            "U.L.DA" => 3,
            "CASADA SECRET" => 2,
            "SEPAARADA" => 6,
            "CIOMERCIANTE" => 6,
            "SECRETARIA" => 6,
            "VIUDA HOGAR" => 5,
            "HOGAR" => 2,
            "SOLTERITA" => 1,
            "U. .L." => 3,
            "U.LADA" => 3,
            "CASAADA" => 2,
            "CASDA" => 2,
            "CASADAHOGRA" => 2,
            "CVIUDA" => 5,
            "CASSADA" => 2,
            "CASAFDA" => 2,
            "CU.L." => 3,
            "ÇSOLTERA" => 1,
            "CVASADA" => 2,
            "EN   CASADA" => 2,
            "SOLREA" => 1,
            "SEOARADA" => 4,
            "CASADA H" => 2,
            "VCASADA" => 2,
            "ROSA" => 1,
            "CASADAD" => 2,
            "CASADO" => 2,
            "CASADA HOGAR" => 2,
            "DIVOR" => 4,
            "DOVORCIADA" => 4,
            "SOLTARE" => 1,
            "COMERCIANTE" => 6,
            "SOLTEREA" => 1,
            "SOLTYERA" => 1,
            "CASADFA" => 2,
            "U.L.HOGAR" => 3,
            "SOLTEERA" => 1,
            "SOLTERO" => 1,
            "U.L.CASADA" => 23,
            "CASADAO" => 2,
            "SOLRTERA" => 1,
            "CASADA HOGRA" => 2,
            "DIVORCIADO" => 4,
            "ASADA" => 2,
            "CASADA+" => 2,
            "SOLTERE" => 1,
            "}ASADA" => 2,
            "SOLETAR" => 1,
            "MENOR" => 1,
            "CASADA}+" => 2,
            "U.L.ul" => 3,
            "CASDADA HOGAR" => 2,
            "DICORCIADA" => 4,
            "CASADSA" => 2,
            "SIOLTERA" => 1,
            ";;;;;;;;;" => 6,
            "UL.L" => 3,
            "-CASADA" => 2,
            "ÇCASADA" => 2,
            "ÇSOLTEREA" => 1,
            "U.LO." => 3,
            "CSOLTYERA" => 1,
            "HOGARCASADA" => 2,
            "PILAR" => 6,
            "ÇU.L." => 3,
            "U.OL." => 3,
            "SOLTERA\MIDIS" => 1,
            "EMPLEADA" => 6,
            "MEDICA" => 6,
            "DOCENTE" => 6,
            "BACTERIOLOGA" => 6,
            "SOTERA" => 1,
            "ABOGADA" => 6,
            "INGENIERA" => 6,
            "ENFERMERA" => 6,
            "U.L.RA" => 3,
            "SOLERA" => 1,
            "SEPARADA EMPL" => 6,
            "SOLTERAADMIN" => 1,
            "SEPRADA" => 6,
            "ING. MECANICA" => 6,
            "COCASADA" => 2,
            "COLTERA" => 1,
            "SPARADA" => 6,
            "SOLTEA" => 1,
            "SOLRTERA]" => 1,
            "SCASADA" => 2,
            "CASADAASOLTER" => 21,
            "SILTERA" => 1,
            "SOILTERA" => 1,
            "casada" => 2,
            "CASADAcasada" => 2,
            "U.L," => 3,
            "U.L ." => 3,
            "PISCOLOGA" => 6,
            "SOLTERAsolter" => 1,
            "SOLTERS" => 1,
            "SOLTERAHOGAR" => 1,
            "CASADA\\" => 2,
            "A" => 6,
            "CASASDA" => 2,
            "CASADA ING AG" => 2,
            "CASADAANTE" => 2,
            "KARIME CASADA" => 2,
            "IOLTERA" => 1,
            "MEDICO" => 6,
            "ACSADA" => 2,
            "SOLTERA\\" => 1,
            "U L.." => 3,
            "SDA" => 1,
            "SDOLTERA" => 1,
            "SOLTERAA" => 1,
            "SOLYTERA" => 1,
            "AESTUDOANTE" => 6,
            "OLTERA" => 1,
            "SOLTERAETEA" => 1,
            "IUDA" => 5,
            "SOLTERTA" => 1,
            "SOLETERA" => 1,
            "SOLETARA" => 1,
            "Soltera" => 1,
            "soltera" => 1,
            "u.l." => 2,
            "U.l." => 2,    
            "SOlTERA" => 1,
            "divorciada" => 4,                                            
        ];

        return $EC_ARRAY[$ecString];
    }

    public function validateStr($string) {
        return $string && $string != '' ? $string . '<br>' : '';
    }
}
