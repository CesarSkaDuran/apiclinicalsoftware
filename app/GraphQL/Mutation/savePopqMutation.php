<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Popq;
use App\Record;

/**
 * CreateFileMutation
 */

class SavePopqMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or uppopq_Ba record'
    ];

    public function type()
    {
        return GraphQL::type('popq');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'popq_Aa' => ['name' => 'popq_Aa', 'type' => Type::string()],
            'popq_Ba' => ['name' => 'popq_Ba', 'type' => Type::string()],
            'popq_C' => ['name' => 'popq_C', 'type' => Type::string()],
            'popq_gh' => ['name' => 'popq_gh', 'type' => Type::string()],
            'popq_pb' => ['name' => 'popq_pb', 'type' => Type::string()],
            'popq_tvl' => ['name' => 'popq_tvl', 'type' => Type::string()],
            'popq_Ap' => ['name' => 'popq_Ap', 'type' => Type::string()],
            'popq_Bp' => ['name' => 'popq_Bp', 'type' => Type::string()],
            'popq_D' => ['name' => 'popq_D', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'record_id' => ['required']
        ];
    }

    public function resolve($root, $args)
    {
        $popq = null;

        if (isset($args['id'])) {
            $popq = Popq::where('id', $args['id'])->first();
        } else {
            $popq = Popq::where('record_id', $args['record_id'])->first();
        }

        if ($popq) {
            if (isset($args['popq_Aa'])) {
                $popq->popq_Aa = $args['popq_Aa'] != '.' ? $args['popq_Aa'] : '';
            }

            if (isset($args['popq_Ba'])) {
                $popq->popq_Ba = $args['popq_Ba'] != '.' ? $args['popq_Ba'] : '';
            }

            if (isset($args['popq_C'])) {
                $popq->popq_C = $args['popq_C'] != '.' ? $args['popq_C'] : '';
            }

            if (isset($args['popq_gh'])) {
                $popq->popq_gh = $args['popq_gh'] != '.' ? $args['popq_gh'] : '';
            }

            if (isset($args['popq_pb'])) {
                $popq->popq_pb = $args['popq_pb'] != '.' ? $args['popq_pb'] : '';
            }

            if (isset($args['popq_tvl'])) {
                $popq->popq_tvl = $args['popq_tvl'] != '.' ? $args['popq_tvl'] : '';
            }

            if (isset($args['popq_Ap'])) {
                $popq->popq_Ap = $args['popq_Ap'] != '.' ? $args['popq_Ap'] : '';
            }

            if (isset($args['popq_Bp'])) {
                $popq->popq_Bp = $args['popq_Bp'] != '.' ? $args['popq_Bp'] : '';
            }

            if (isset($args['popq_D'])) {
                $popq->popq_D = $args['popq_D'] != '.' ? $args['popq_D'] : '';
            }

            $popq->save();            
        } else {
            // make user with data
            $popq = Popq::create([
                'record_id' => $args['record_id'],
                'popq_Aa' => isset($args['popq_Aa']) && $args['popq_Aa'] != '.' ?  $args['popq_Aa'] : null,
                'popq_Ba' => isset($args['popq_Ba']) && $args['popq_Ba'] != '.' ?  $args['popq_Ba'] : null,
                'popq_C' => isset($args['popq_C']) && $args['popq_C'] != '.' ?  $args['popq_C'] : null,
                'popq_gh' => isset($args['popq_gh']) && $args['popq_gh'] != '.' ?  $args['popq_gh'] : null,
                'popq_pb' => isset($args['popq_pb']) && $args['popq_pb'] != '.' ?  $args['popq_pb'] : null,
                'popq_tvl' => isset($args['popq_tvl']) && $args['popq_tvl'] != '.' ?  $args['popq_tvl'] : null,
                'popq_Ap' => isset($args['popq_Ap']) && $args['popq_Ap'] != '.' ?  $args['popq_Ap'] : null,
                'popq_Bp' => isset($args['popq_Bp']) && $args['popq_Bp'] != '.' ?  $args['popq_Bp'] : null,
                'popq_D' => isset($args['popq_D']) && $args['popq_D'] != '.' ?  $args['popq_D'] : null,
            ]);
        }

        return $popq;
    }

}

