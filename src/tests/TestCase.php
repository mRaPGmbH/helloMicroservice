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
            if ($field === 'tenant_id') {
                continue;
            }
            self::assertEquals($model->$field, $compareModel->$field, get_class($model).'->'.$field.' database value:');
        }
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @throws Exception
     */
    protected function creationTest(string $classname, array $select = ['id']): void
    {
        $this->creationUpdateTestImplementation($classname, $select, 'create');
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @throws Exception
     */
    protected function updateTest(string $classname, array $select = ['id']): void
    {
        $this->creationUpdateTestImplementation($classname, $select, 'update');
    }

    protected function deletionTest(string $classname, array $select = ['id']): void
    {
        /** @var Model $model */
        $model = $classname::first();
        $shortClassname = $this->getShortClassname($classname);
        $query = 'mutation { delete' . $shortClassname . '(';
        $query .= implode(', ', $this->getFindBy($model, $select));
        $query .= ') { ' . implode( ', ', $select) . ' } }';
        $json = [
            'data' => [
                'delete'.$shortClassname => $select
            ]
        ];
        $response = $this->jwt()->graphQL($query);
        $response->assertStatus(200);
        $response->assertJsonStructure($json);

        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model))) {
            $this->assertSoftDeleted($model);
        } else {
            $this->assertDeleted($model);
        }
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @param string $type
     * @throws Exception
     */
    private function creationUpdateTestImplementation(string $classname, array $select = ['id'], string $type = 'create'): void
    {
        $shortClassname = $this->getShortClassname($classname);
        if ($type === 'update') {
            $model = $classname::first();
            $new = factory($classname)->make();
            foreach ($model->getFillable() as $field) {
                if ($field === 'tenant_id' || in_array($field, $select, true)) {
                    continue;
                }
                $model->$field = $new->$field;
            }
            [$query, $jsonStructure] = $this->createMutation('update'.$shortClassname, $model, $select, (!$model instanceof CustomMutations));
        } else {
            $model = factory($classname)->make();
            [$query, $jsonStructure] = $this->createMutation('create'.$shortClassname, $model, $select, false);
        }
        $response = $this->jwt()->graphQL($query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        if ($type === 'create' && !$model instanceof CustomMutations) {
            $model->id = $response->json('data')[$type.$shortClassname]['id'];
        }
        self::assertModelEqualsDatabase($model);
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @throws Exception
     */
    protected function listTest(string $classname, array $select = ['id']): void
    {
        $this->listReadTestImplementation($classname, $select, true);
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @throws Exception
     */
    protected function readTest(string $classname, array $select = ['id']): void
    {
        $this->listReadTestImplementation($classname, $select, false);
    }

    /**
     * @param string $classname
     * @param string[] $select
     * @param bool $list
     * @throws Exception
     */
    private function listReadTestImplementation(string $classname, array $select = ['id'], $list = false): void
    {
        $compareModel = $classname::first();
        $shortClassname = lcfirst($this->getShortClassname($classname));
        [$query, $jsonStructure] = $this->createQuery($shortClassname, $compareModel, $select, $list);
        $response = $this->jwt()->graphQL($query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);

        $model = new $classname();
        if ($list) {
            $model->fill($response->json('data')[$shortClassname.'s']['data'][0]);
        } else {
            $model->fill($response->json('data')[$shortClassname]);
        }
        if (!$model instanceof CustomMutations) {
            $model->id = $compareModel->id;
        }
        self::assertModelEqualsDatabase($model);
    }

    /**
     * @param string $name
     * @param Model $model
     * @param string[] $select
     * @return array
     */
    private function createMutation(string $name, Model $model, array $select = ['id'], bool $includeId = false): array
    {
        $query = 'mutation { ' . $name . '(';
        $query .= implode(' ', $this->getFields($model, $includeId));
        $query .= ') { ' . implode( ', ', $select) . ' } }';
        $json = [
            'data' => [
                $name => $select
            ]
        ];
        return [$query, $json];
    }

    /**
     * @param Model $model
     * @param bool $includeId
     * @return array
     */
    private function getFields(Model $model, bool $includeId = false): array
    {
        $fields = [];
        if ($includeId) {
            $fields[] = 'id:'.$model->id;
        }
        $casts = $model->getCasts();
        foreach ($model->getFillable() as $field) {
            if ($field === 'tenant_id') {
                continue;
            }
            if ($field === 'country_code') {
                $fields[] = $field . ':' . $model->$field. ' ';
                continue;
            }
            if (is_null($model->$field)) {
                $fields[] = $field . ':null';
                continue;
            }
            switch ($casts[$field] ?? 'string') {
                case 'string':
                default:
                    $fields[] = $field . ':"' . str_replace(['"', "\n"], ['\\"', ''], $model->$field) . '"';
                    break;
                case 'integer':
                case 'real':
                case 'float':
                case 'double':
                case 'timestamp':
                    $fields[] = $field . ':' . $model->$field;
                    break;
                case 'boolean':
                    $fields[] = $field . ':' . ($model->$field? 'true' : 'false');
                    break;
                case 'date':
                    $fields[] = $field . ':"' . ($model->$field->format('Y-m-d')). '"';
                    break;
                case 'datetime':
                    $fields[] = $field . ':"' . ($model->$field->format('Y-m-d H:i:s')) . '"';
                    break;
            }
        }
        return $fields;
    }

    /**
     * @param string $name
     * @param Model $model
     * @param string[] $select
     * @param bool $list
     * @return array
     */
    private function createQuery(string $name, Model $model, array $select = ['id'], $list = false): array
    {
        if ($list) {
            $name .= 's';
        }
        $query = '{ ' . $name . '(';
        $query .= implode(', ', $this->getFindBy($model, $select)). ')';
        if ($list) {
            $query .= '{ data';
        }
        $fields = array_diff($model->getFillable(), ['tenant_id']);

        $query .= '{' . implode(' ', $fields) . '}}';
        if ($list) {
            $query .= '}';
            $json = [
                'data' => [
                    $name => ['data' => [$fields]]
                ]
            ];
        } else {
            $json = [
                'data' => [
                    $name => $fields
                ]
            ];
        }
        return [$query, $json];
    }

    /**
     * @param Model $model
     * @param string[] $select
     * @return string[]
     */
    private function getFindBy(Model $model, array $select = ['id']) {
        $find = [];
        foreach ($select as $field) {
            $value = $model->$field;
            if (is_int($value)) {
                $find[] = $field . ':' . $value;
            } else {
                $find[] = $field . ':"' . str_replace(['"', "\n"], ['\\"', ''], $value) . '"';
            }
        }
        return $find;
    }

    /**
     * @param string $longClassname
     * @return string
     */
    private function getShortClassname(string $longClassname): string
    {
        $array = explode('\\', $longClassname);
        return array_pop($array);
    }

}
