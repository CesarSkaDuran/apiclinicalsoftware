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
use App\Gasto;
use Carbon\Carbon;

/**

 * CompaniesQuery

 */

class GastoPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return GraphQL::type('gastoPagination');
    }



    public function args()

    {

        return array_merge([

            'date' => ['name' => 'date', 'type' => Type::string()],

            'date2' => ['name' => 'date2', 'type' => Type::string()],

            'search' => ['name' => 'search', 'type' => Type::string()],

            'date3' => ['name' => 'date3', 'type' => Type::string()],  

            'status' => ['name' => 'status', 'type' => Type::int()],

            // 'app_user_id' => ['name' => 'user_id', 'type' => Type::int()],

        ], AdvancedQuery::queryParams());
    }



    public function resolve($root, $args, $context, ResolveInfo $info)

    {

        $currentUser = auth('api')->user();




        // Prepare query

        // $AfiliacionQuery = Afiliacion::query();
        $AfiliacionQuery = Gasto::query();

        $appointmentsQuery = AdvancedQuery::extendQuery($AfiliacionQuery, $args);

        $Afiliacion = $appointmentsQuery->where('user_id', $currentUser->id)->get();


        // $Afiliacion = Afiliacion::where('status', 1)->orWhere('status', 2)->orWhere('status',3)->orWhere('status', 5);


        // $AfiliacionQuery->where('user_id', $currentUser->id);



        // Filter
        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];



            $AfiliacionQuery

                ->where(function ($querySe) use ($searchString) {

                    return $querySe

                        ->orWhere('nombre', 'like', '%' . $searchString . '%')
                        // ->orWhere('status', 'like', '%' . $searchString . '%')
                        ->orWhere('valor', 'like', '%' . $searchString . '%');
                });
        }


        if (!isset($args['date']) && !isset($args['date2'])) {

            $appointmentsQuery->whereDate('fecha',  date('Y-m-d'));
        }
        if (isset($args['date']) && !isset($args['date2'])) {

            $appointmentsQuery->whereDate('fecha', '>=', $args['date']);
        }
        if (!isset($args['date']) && isset($args['date2'])) {

            $appointmentsQuery->whereDate('fecha', '=<', $args['date']);
        }

        if (isset($args['date']) && isset($args['date2'])) {

            $appointmentsQuery->whereBetween('fecha',  [$args['date'], $args['date2']]);
        }


        // filter by status

        if (isset($args['status'])) {

            $AfiliacionQuery->where('status', $args['status']);
        }
        //  else {

        //     $AfiliacionQuery->where('status', '!=', 9);
        // }


        // $dias = Carbon::parse($compra->fecha)->day;

        // $fechaAntigua  = Gasto::where('status', '=', '1')->first()->created_at;
        // $fechaReciente = Gasto::where('status', '=', '1')->first()->updated_at;

        // $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);


        $total = $AfiliacionQuery->count();

        $totales = $AfiliacionQuery->get();

        // get data

        if (count($args) > 0) {

            $appointmentsQuery = AdvancedQuery::extendQuery($AfiliacionQuery, $args);

            $Afiliacion = $appointmentsQuery->orderBy('status', 'asc')->get();

            $compra = Gasto::where('status', '=', '1')->first();
            if ($compra) {

                $fechaAntigua  = Gasto::where('status', '=', '1')->first()->created_at;
                $fechaReciente = Gasto::where('status', '=', '1')->first()->updated_at;

                $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
            }


            // if ($compra) {

            //     if ($cantidadDias >= 30) {

            //         $date = Carbon::now();

            //         $compra->status = 2;

            //         $compra->meses = $compra->meses + 1;

            //         $compra->created_at = $date->startOfMonth();

            //         $compra->updated_at = $date->addMonth()->startOfMonth();

            //         $compra->save();
            //     }
            // }
        } else {

            // not args, then get all

            $Afiliacion = Gasto::all();
        }



        return ['data' => $Afiliacion, 'total' => $total,'totales' => $totales,];
    }
}
