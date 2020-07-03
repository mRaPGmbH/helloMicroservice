<?php


namespace HelloCash\HelloMicroservice\GraphQL\Mutations;


use GraphQL\Type\Definition\ResolveInfo;

abstract class MutationBase
{

    /**
     * get requested return type (model) as defined in schema.graphql
     * and throw an Exception if it is not a model that implements the customMutations interface
     *
     * @param ResolveInfo $resolveInfo
     * @return string
     */
    protected function getClassName(ResolveInfo $resolveInfo): string
    {
        // TODO: configurable path instead of hardcoded App\
        // because of differences between nullable and non-null schemas, only ->toString() works here
        $className = str_replace('!', '', 'App\\' . $resolveInfo->returnType->toString());
        if (!class_exists($className)) {
            throw new \RuntimeException(__CLASS__ . ': Model ' . $className . ' not found.');
        }
        if (!in_array('HelloCash\\HelloMicroservice\\Interfaces\\CustomMutations', class_implements($className), true)) {
            throw new \RuntimeException(__CLASS__ . ': Model ' . $className . ' does not implement customMutations interface.');
        }
        return $className;
    }

}
