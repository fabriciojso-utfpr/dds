<?php

namespace DDS\GraphQL;


use Folklore\GraphQL\Support\Type;

abstract class AbstractBaseType extends Type {

     protected final function getFieldResolver($name, $field)
    {
        return parent::getFieldResolver($name, $field) ?? function ($object, $args, $context, $rf) {
            return (new \ReflectionMethod($object, 'get' . studly_case($rf->fieldName)))->invoke($object);
        };
    }
}