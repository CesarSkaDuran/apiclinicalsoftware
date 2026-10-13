<?php



namespace App\GraphQL\Query;


use Illuminate\Support\Facades\Auth;
use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Afiliacion;
use App\CuentaCobro;
use App\Patient;
use App\Tercero;
use Carbon\Carbon;

/**

 * CompaniesQuery

 */

class CuentaCobroPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return GraphQL::type('cuentaCobroPagination');
    }



    public function args()

    {

        return array_merge([

            'date' => ['name' => 'date', 'type' => Type::string()],

            'date2' => ['name' => 'date2', 'type' => Type::string()],

            'date3' => ['name' => 'date3', 'type' => Type::string()],

            'search' => ['name' => 'search', 'type' => Type::string()],

            'status' => ['name' => 'status', 'type' => Type::int()],

            'tipo' => ['name' => 'tipo', 'type' => Type::int()],

            'dataHoy' => ['name' => 'dataHoy', 'type' => Type::int()],

            'id_afiliacion' => ['name' => 'id_afiliacion', 'type' => Type::int()],

        ], AdvancedQuery::queryParams());
    }



    public function resolve($root, $args, $context, ResolveInfo $info)

    {

        $currentUser = auth('api')->user();

        // Prepare query

        // $AfiliacionQuery = Afiliacion::query();
     

            $AfiliacionQuery = CuentaCobro::query()->where('user_id', $currentUser->id);

            // $appointmentsQuery = AdvancedQuery::extendQuery($AfiliacionQuery, $args);

            $Afiliacion = $AfiliacionQuery->get();

            // $Afiliacion = CuentaCobro::all();
        
        // Filter
        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $tercero = Tercero::where(function ($querySe) use ($searchString) {

                    return $querySe
                        ->orWhere('documento', 'like', '%' . $searchString . '%')
                        ->orWhere('nombre', 'like', '%' . $searchString . '%');
                })->first();
     
            
            if($tercero)
            {
                
                 $AfiliacionQuery->orWhere('tercero_id', $tercero->id);
                
            }

            else
            
            {
                $AfiliacionQuery

                    ->where(function ($querySe) use ($searchString) {

                        return $querySe
                            // ->orWhere('id', 'like', '%' . $searchString . '%')
                            ->orWhere('nombre_empresa', 'like', '%' . $searchString . '%');
                    });
            }
  
        }


        if (isset($args['dataHoy'])) {

            // if (!isset($args['date']) && !isset($args['date2'])) {

            $AfiliacionQuery->whereDate('fecha',  date('Y-m-d'));
            // }
        }
        if (isset($args['date']) && !isset($args['date2'])) {

            $AfiliacionQuery->whereDate('fecha', '>=', $args['date']);
        }
        if (!isset($args['date']) && isset($args['date2'])) {

            $AfiliacionQuery->whereDate('fecha', '=<', $args['date']);
        }

        if (isset($args['date']) && isset($args['date2'])) {

            $AfiliacionQuery->whereBetween('fecha',  [$args['date'], $args['date2']]);
        }



        // filter by status

        if (isset($args['status'])) {

            $AfiliacionQuery->where('status', $args['status']);
        }



        $total = $AfiliacionQuery->count();



        // get data

        if (count($args) > 0) {

            $appointmentsQuery = AdvancedQuery::extendQuery($AfiliacionQuery, $args);

            $Afiliacion = $appointmentsQuery->orderBy('created_at', 'desc')->get();
        } else {

            // not args, then get all

            $Afiliacion = CuentaCobro::all();
        }



        return ['data' => $Afiliacion, 'total' => $total];
    }
}
