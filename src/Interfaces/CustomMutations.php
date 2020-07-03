<?php


namespace HelloCash\HelloMicroservice\Interfaces;


use Illuminate\Database\Eloquent\Builder;

interface CustomMutations
{
    /**
     * @param array $args
     * @return Builder
     */
    public static function queryForMutations(array $args): Builder;
}
