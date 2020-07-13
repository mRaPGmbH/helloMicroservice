<?php

namespace HelloCash\HelloMicroservice\tests;

use Exception;
use HelloCash\HelloMicroservice\Interfaces\CustomMutations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('config:clear'); // nur zur sicherheit
    }

    /**
     * @return TestCase
     */
    protected function jwt(): TestCase
    {
        return $this->withHeader('Authorization', 'Bearer '.$this->getToken());
    }

    /**
     * @return string
     */
    protected function getToken(): string
    {
        // this token expires in 2030
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOjEyMywiYXVkIjoiZm9vIiwidGlkIjoxLCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MCIsImlhdCI6MTU5MzUwOTYxNSwiZXhwIjoxOTAxMDkzNjE1LCJuYmYiOjE1OTM1MDk2MTUsImp0aSI6Inh4MHFYNzMydTVSdGFBNDkifQ.KNOhgi8OzGNrWXT0T0a66Ifk1AX-q2PFGo6YEskz9aHrO4yepK5HmxHyYval6RxjvV22z4p4r4Z_h1EtSUJHovZviWBzXgiOxQXAUlnBWJebpl256D5u0b7JDx2mOR6VZuu6nCpEGr6lq38VuW_yiVyJLhTdvfLVzF6rEFsnI54jBUlK1k5zmPDImzBJUoPa-BvAgOwLUfvDdiudsMs-a3tiZ5me7JmRaktPq6s_dGGjWVzeVAYD8rfs-WlHUJg0DkNbQWN9iPdnChryopwE7KjWZBKQPSH8RNuWd_eC0FQN97mcfPIAs_FBqiOQP0C8p1_2bvw8VpcGBp88DDPlZg';
    }

    /**
     * @param Model $model
     * @throws Exception
     */
    protected static function assertModelEqualsDatabase(Model $model): void
    {
        $compareModel = null;
        if ($model instanceof CustomMutations) {
            $model->attributesToArray();
            $compareModel = $model::queryForMutations($model->attributesToArray())->first();
        } else {
            if (empty($model->id)) throw new Exception('Id is not set in model!');
            $compareModel = $model::find($model->id);
        }
        foreach ($model->getFillable() as $field) {
            self::assertEquals($model->$field, $compareModel->$field, get_class($model).'->'.$field.' database value:');
        }
    }

    /**
     * @param string $classname
     * @param string $select
     * @throws Exception
     */
    protected function creationTest($classname, $select = 'id'): void
    {
        $model = factory($classname)->make();
        $array = explode('\\', $classname);
        $shortClassname = array_pop($array);
        [$query, $jsonStructure] = $this->createMutation('create'.$shortClassname, $model, $select);
        $response = $this->jwt()->graphQL($query);
        //$this->addWarning('GRAPHQL: '.$query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        if (!$model instanceof CustomMutations) {
            $model->id = $response->json('data')['create'.$shortClassname]['id'];
        }
        self::assertModelEqualsDatabase($model);
    }

    /**
     * @param string $name
     * @param Model $model
     * @param string|array $select
     * @return array
     */
    protected function createMutation(string $name, Model $model, $select): array
    {
        $query = 'mutation { ' . $name . '(';
        $casts = $model->getCasts();
        foreach ($model->getFillable() as $field) {
            if ($field === 'tenant_id') {
                continue;
            }
            if ($field === 'country_code') {
                $query .= $field . ':' . $model->$field. ' ';
                continue;
            }
            if (is_null($model->$field)) {
                continue;
            }
            switch ($casts[$field] ?? 'string') {
                case 'string':
                default:
                    $query .= $field . ':"' . str_replace(['"', "\n"], ['\\"', ''], $model->$field) . '"';
                    break;
                case 'integer':
                case 'real':
                case 'float':
                case 'double':
                case 'timestamp':
                    $query .= $field . ':' . $model->$field;
                    break;
                case 'boolean':
                    $query .= $field . ':' . ($model->$field? 'true' : 'false');
                    break;
                case 'date':
                    $query .= $field . ':"' . ($model->$field->format('Y-m-d')). '"';
                    break;
                case 'datetime':
                    $query .= $field . ':"' . ($model->$field->format('Y-m-d H:i:s')) . '"';
                    break;
            }
            $query .= ' ';
        }
        if (is_array($select)) {
            $query .= ') { ' . implode( ', ', $select) . ' } }';
        } else {
            $query .= ') { ' . $select . ' } }';
            $select = [$select];
        }

        $json = [
            'data' => [
                $name => $select
            ]
        ];
        return [$query, $json];
    }

}
