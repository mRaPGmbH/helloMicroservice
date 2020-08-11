<?php

namespace HelloCash\HelloMicroservice\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpdateMutation extends MutationBase
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param mixed[] $args The arguments that were passed into the field.
     * @param GraphQLContext $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        DB::beginTransaction();
        try {
            $className = $this->getClassName($resolveInfo);
            $model = $className::queryForMutations($args)->firstOrFail();
            foreach ($model->getFillable() as $fillable) {
                if (array_key_exists($fillable, $args)) {
                    $model->$fillable = $args[$fillable];
                }
            }
            $model->save();
            DB::commit();
            return $model;
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return $e;
        }
    }
}
