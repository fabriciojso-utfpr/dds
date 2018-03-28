<?php

namespace DDS\GraphQL\Type;

use DDS\Entities\Site\Site;
use DDS\GraphQL\AbstractBaseType;
use GraphQL\Type\Definition\Type;
use GraphQL;

class SiteType extends AbstractBaseType
{
    protected $attributes = [
        'name' => 'Site',
        'description' => 'Um site é uma equipe de trabalho distribuida.'
    ];

    public function fields()
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::id()),
                'description'=>'O identificador do Site'
            ],
            'description'=>[
                'type'=>Type::nonNull(Type::string()),
                'description'=>'Descrição da equipe.'
            ],
            'birth'=>[
                'type'=>Type::nonNull(Type::string()),
                'description'=>'Data da criação da equipe.'
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

}
