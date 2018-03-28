<?php

namespace DDS\GraphQL\Query;

use DDS\Repository\SiteRepository;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class SitesQuery extends Query
{
    protected $attributes = [
        'name' => 'Site',
        'description' => 'Execute consultas nos Sites.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Site'));
    }

    public function args()
    {
        return [
            'id'=>[
                'name'=>'id',
                'type'=>Type::id()
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $siteRepository = new SiteRepository();
        if(isset($args['id'])){

            return [$siteRepository->findOneBy(['id'=>$args['id']])];
        }else{
            return $siteRepository->findAll();
        }
    }
}
