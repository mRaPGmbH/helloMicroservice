<?php


namespace HelloCash\HelloMicroservice\Traits;


use Illuminate\Database\Eloquent\Builder;

trait CustomMutations
{

    /**
     * @return string[]
     */
    abstract public static function getPrimaryKeyFields(): array;

    /**
     * @param array $args
     * @return Builder
     */
    public static function queryForMutations(array $args): Builder
    {
        $builder = null;
        foreach (static::getPrimaryKeyFields() as $field) {
            if (is_null($builder)) {
                $builder = self::where($field, 'LIKE', $args[$field]);
            } else {
                $builder = $builder->where($field, 'LIKE', $args[$field]);
            }
        }
        return $builder;
    }

}
