<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\PaymentInfo;



/**

 * CompaniesQuery

 */

class PaymentInfoQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return GraphQL::type('paymentInfo');
    }

    public function args()
    {
        return array_merge([
            'status' => ['name' => 'status', 'type' => Type::int()],
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $paymentInfo = PaymentInfo::first();

        return $paymentInfo;
    }
}
