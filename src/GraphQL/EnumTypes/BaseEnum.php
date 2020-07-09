<?php


namespace HelloCash\HelloMicroservice\GraphQL\EnumTypes;


use GraphQL\Type\Definition\EnumType;

abstract class BaseEnum
{

    abstract static function get(): EnumType;

    public static function getAsHash(): array
    {
        $hash = [];
        foreach (static::get()->getValues() as $type) {
            $hash[$type->name] = $type->description;
        }
        return $hash;
    }

    public static function getCountryNameForCode($code)
    {
        $hash = self::getAsHash();
        return $hash[$code] ?? $hash['XX'];
    }

}
