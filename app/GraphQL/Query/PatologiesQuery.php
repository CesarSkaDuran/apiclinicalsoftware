<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Patology;
use App\AppPatient;



/**

 * CompaniesQuery

 */

class PatologiesQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return Type::listOf(GraphQL::type('patology'));
    }

    public function args()
    {
        return array_merge([
            'status' => ['name' => 'status', 'type' => Type::int()],
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $currentUser = auth('api')->user();
        $appUser = AppPatient::where('user_id', $currentUser->id)->first();

        if (!$appUser) {
            abort(404, 'App Patient not found');
        }

        $patologies = Patology::where('app_user_id', $appUser->id)->get();

        return $patologies;
    }
}
