<?php


namespace HelloCash\HelloMicroservice\GraphQL\EnumTypes;


use GraphQL\Type\Definition\EnumType;

abstract class BaseEnum
{

    abstract static function get(): EnumType;

    public static function getAsHash($lang = 'en'): array
    {
        $hash = [];
        foreach (static::get()->getValues() as $type) {
            $hash[$type->name] = $type->description;
        }
        return $hash;
    }

}
