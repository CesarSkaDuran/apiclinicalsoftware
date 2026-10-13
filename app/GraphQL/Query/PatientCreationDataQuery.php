<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Arl;
use App\Eps;
use App\Pension;



/**

 * CompaniesQuery

 */

class PatientCreationDataQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return GraphQL::type('patientCreationData');
    }

    public function args()
    {
        return array_merge([
            'status' => ['name' => 'status', 'type' => Type::int()],
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $arls = Arl::all();
        $epss = Eps::all();
        $pensions = Pension::all();

        return [
            'arls' => $arls,
            'epss' => $epss,
            'pensions' => $pensions
        ];
    }
}
