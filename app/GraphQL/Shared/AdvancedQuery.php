<?php

namespace App\GraphQL\Shared;

use GraphQL\Type\Definition\Type;

class AdvancedQuery
{
    public static function extendQuery($model, $args)
    {
        if (isset($args['orderby'])) {
            $order = isset($args['order']) && ($args['order'] == 'asc' ||  $args['order'] == 'desc') ? $args['order'] : 'asc';

            $model->orderBy($args['orderby'], $order);
        }

        if (isset($args['limit'])) {
            $model->limit($args['limit']);
        }

        if (isset($args['offset'])) {
            $model->offset($args['offset']);
        }

        return $model;
    }

    public static function queryParams()
    {
        return [
            'orderby' => ['name' => 'orderby', 'type' => Type::string()],
            'order' => ['name' => 'order', 'type' => Type::string()],
            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'offset' => ['name' => 'offset', 'type' => Type::int()],
        ];
    }
}
