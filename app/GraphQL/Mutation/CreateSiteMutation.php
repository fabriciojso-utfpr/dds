<?php

namespace DDS\GraphQL\Mutation;

use DDS\Entities\Site\Site;
use DDS\Repository\SiteRepository;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class CreateSiteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createSite',
        'description' => 'Inserir um usuário'
    ];

    public function type()
    {
        return GraphQL::type('Site');
    }

    public function args()
    {
        return [
            'description'=>[
                'type'=>Type::nonNull(Type::string()),
                'description'=>'Descrição da equipe.'
            ],
            'timezone'=>[
                'type'=>Type::string(),
                'description'=>'Timezone da equipe.'
            ],
            'geocoors'=>[
                'type'=>Type::string(),
                'description'=>'ordenadas geográfica (latitude, longitude) da localização da equipe.'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {

        $siteRepository = new SiteRepository();
        $site = new Site();
        $site->setDescription($args['description'])
             ->setBirth(new \DateTime('now'))
             ->setTimezone(new \DateTimeZone($args['timezone'] ?? null))
             ->setGeocoors($args['geocoors'] ?? null);

        $siteRepository->save($site);

        return $site;
    }
}
