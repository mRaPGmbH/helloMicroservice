<?php

namespace HelloCash\HelloMicroservice\tests;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
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

    protected function jwtGuest(): TestCase
    {
        return $this->withHeader('Authorization', 'Bearer ' . $this->getGuestToken());
    }

    /**
     * @return string
     */
    protected function getGuestToken(): string
    {
        // token without adm claim, expires in 2030
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOjEyMywiYXVkIjoiZm9vIiwidGlkIjoxLCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MCIsImlhdCI6MTU5MzUwOTYxNSwiZXhwIjoxOTAxMDkzNjE1LCJuYmYiOjE1OTM1MDk2MTUsImp0aSI6Inh4MHFYNzMydTVSdGFBNDkifQ.KNOhgi8OzGNrWXT0T0a66Ifk1AX-q2PFGo6YEskz9aHrO4yepK5HmxHyYval6RxjvV22z4p4r4Z_h1EtSUJHovZviWBzXgiOxQXAUlnBWJebpl256D5u0b7JDx2mOR6VZuu6nCpEGr6lq38VuW_yiVyJLhTdvfLVzF6rEFsnI54jBUlK1k5zmPDImzBJUoPa-BvAgOwLUfvDdiudsMs-a3tiZ5me7JmRaktPq6s_dGGjWVzeVAYD8rfs-WlHUJg0DkNbQWN9iPdnChryopwE7KjWZBKQPSH8RNuWd_eC0FQN97mcfPIAs_FBqiOQP0C8p1_2bvw8VpcGBp88DDPlZg';
    }

    protected function jwtExpired(): TestCase
    {
        return $this->withHeader('Authorization', 'Bearer ' . $this->getExpiredToken());
    }

    /**
     * @return string
     */
    protected function getExpiredToken(): string
    {
        // token that has expired
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOjEyMywiYXVkIjoiaGVsbG9DYXNoIiwidGlkIjoxLCJhZG0iOnRydWUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDoxMDIwMVwvdG9rZW4iLCJpYXQiOjE1OTg4ODI1MDMsImV4cCI6MTU5ODg4MjU2MywibmJmIjoxNTk4ODgyNTAzLCJqdGkiOiJEQUl6RjFnMllWYllwSlE5In0.ayQutwNvaEgdrYsEwCUI5XhIvFcr5TLRh4FsAsD5arkcYgnR55KMPsGFNgDjY4slI45O7EgJSWswHAnITNuuXcK3JBUx1z7G3VmvYHdD-OEVr29DKUZThU3gykmceQGsjF1Veq4bDtux0XCHZaj5dhAUPd_O9-7y8bIkWhxjRTyheytXwCTi3bMubJ5chYS1R0WfAmdt4GJnbW0n7UzG-lAM6PYYsnfYzXLHqCfDxUML-w2xqJHBfW89G3V8Fef3rclaMKF5UxiKx7nf_i-mWAgBjQTCicgOVtbtHRY4GbQg5Xb4jkD7n9-84gOaWMHd1oZRAXsm4rXKeYXCEbb3iQ';
    }

    protected function jwtCorrupted(): TestCase
    {
        return $this->withHeader('Authorization', 'Bearer ' . $this->getCorruptedToken());
    }

    /**
     * @return string
     */
    protected function getCorruptedToken(): string
    {
        // data has been hacked, signature does not match
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOjEyMywiYXVkIjoiaGVsbG9DYXNoIiwidGlkIjoxLCJhZG0iOnRydWUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDoxMDIwMVwvdG9rZW4iLCJpYXQiOjE1OTczMDY4MTksImV4cCI6MTkwNDg5MDgxOSwibmJmIjoxNTk3MzA2ODE5LCJqdGkiOiJKQ2F1YjExNXhLTXZ3bmdaIn0.KNOhgi8OzGNrWXT0T0a66Ifk1AX-q2PFGo6YEskz9aHrO4yepK5HmxHyYval6RxjvV22z4p4r4Z_h1EtSUJHovZviWBzXgiOxQXAUlnBWJebpl256D5u0b7JDx2mOR6VZuu6nCpEGr6lq38VuW_yiVyJLhTdvfLVzF6rEFsnI54jBUlK1k5zmPDImzBJUoPa-BvAgOwLUfvDdiudsMs-a3tiZ5me7JmRaktPq6s_dGGjWVzeVAYD8rfs-WlHUJg0DkNbQWN9iPdnChryopwE7KjWZBKQPSH8RNuWd_eC0FQN97mcfPIAs_FBqiOQP0C8p1_2bvw8VpcGBp88DDPlZg';
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function creationTest(string $classname): void
    {
        $shortClassname = 'create' . $this->getShortClassname($classname);
        $model = factory($classname)->make();
        [$query, $jsonStructure] = $this->createMutation($shortClassname, $model, false);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            $model->id = $response->json('data')[$shortClassname]['id'];
        }
        self::assertModelEqualsDatabase($model);
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

    /**
     * @param string $name
     * @param Model $model
     * @param bool $includeId
     * @return array
     */
    private function createMutation(string $name, Model $model, bool $includeId = false): array
    {
        $query = 'mutation { ' . $name . '(';
        $query .= implode(' ', $this->getFields($model, $includeId));
        $query .= ') { ' . implode(', ', $this->getSelect($model)) . ' } }';
        $json = [
            'data' => [
                $name => $this->getSelect($model)
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
        $schema = $this->getFieldsSchema($model);
        $fields = [];
        if ($includeId) {
            $fields[] = 'id:' . $model->id;
        }
        foreach ($model->getFillable() as $field) {
            if ($field === 'tenant_id') {
                continue;
            }
            if (($schema[$field] ?? null) === 'ENUM') {
                $fields[] = $field . ':' . $model->$field . ' ';
                continue;
            }
            if (is_null($model->$field)) {
                $fields[] = $field . ':null';
                continue;
            }
            $fields[] = $this->createFieldFromCasts($model, $field);
        }
        return $fields;
    }

    /**
     * uses introspection to get information about the schema and then extracts information
     * about the fields of the type which matches the given model
     *
     * @param Model $model
     * @return array
     */
    private function getFieldsSchema(Model $model): array
    {
        $json = json_decode($this->introspect()->content(), false, 512, JSON_THROW_ON_ERROR);
        $schemaFields = null;
        foreach ($json->data->__schema->types as $type) {
            if ($type->name === $this->getShortClassname(get_class($model))) {
                $schemaFields = $type->fields;
            }
        }
        $fields = [];
        foreach ($schemaFields as $field) {
            if ($field->type->kind === 'NON_NULL') {
                $fields[$field->name] = $field->type->ofType->kind;
            } else {
                $fields[$field->name] = $field->type->kind;
            }
        }
        return $fields;
    }

    /**
     * @param Model $model
     * @param string $key
     * @return string
     */
    private function createFieldFromCasts(Model $model, string $key): string
    {
        $casts = $model->getCasts();
        switch ($casts[$key] ?? 'string') {
            case 'string':
            default:
                return $key . ':"' . str_replace(['"', "\n"], ['\\"', ''], $model->$key) . '"';
            case 'integer':
            case 'real':
            case 'float':
            case 'double':
            case 'timestamp':
                return $key . ':' . $model->$key;
            case 'boolean':
                return $key . ':' . ($model->$key ? 'true' : 'false');
            case 'date':
                return $key . ':"' . ($model->$key->format('Y-m-d')) . '"';
            case 'datetime':
                return $key . ':"' . ($model->$key->format('Y-m-d H:i:s')) . '"';
        }
    }

    /**
     * @param $model
     * @return string[]
     */
    private function getSelect(Model $model): array
    {
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            return $model->getPrimaryKeyFields();
        }
        return ['id'];
    }

    /**
     * @return TestCase
     */
    protected function jwt(): TestCase
    {
        return $this->withHeader('Authorization', 'Bearer ' . $this->getToken());
    }

    /**
     * @return string
     */
    protected function getToken(): string
    {
        // token with adm=true, expires in 2030
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOjEyMywiYXVkIjoiaGVsbG9DYXNoIiwidGlkIjoxLCJhZG0iOnRydWUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDoxMDIwMVwvdG9rZW4iLCJpYXQiOjE1OTczMDY4MTksImV4cCI6MTkwNDg5MDgxOSwibmJmIjoxNTk3MzA2ODE5LCJqdGkiOiJKQ2F1YjExNXhLTXZ3bmdaIn0.CoK4Tb7U6AFHQ95cJaq_CApL1N3eHeUe3cPD4H6bafe4yUq6dVpmKPBtPkpfo_Vl3tWNGA868oCK4SI5ibv-T2oH0bQOnC0lP0liXtoS83cTr0SqTOZTcuH9ojmi_4MJ_GwxSiIgHhH8d-7PvQtKboYX-6NSTMpiOKz_QZnfjHaiiJ31w5cBkav-JHd64dcgNzWVo-BpmIIBYoblGaByOPzYJRhWH7Xho03AXKgEzsXUDeNfrvgtN-fF9zeXRVGMgCvZUs4jq3_uRmLXO3aNDLMBCmpBMdwypYoyyI7PTwieadH9PZkr8r2uBZMRPjKX8l_F43mV8FGa1T-b6G5z5A';
    }

    /**
     * @param TestResponse $response
     * @param string $query
     * @param bool $ignoreErrors
     * @throws Exception
     */
    private function debug(TestResponse $response, string $query = 'n/a', bool $ignoreErrors = false): void
    {
        if ($response->status() === 500) {
            throw $response->exception;
        }
        $json = $response->json();
        if (isset($json['errors'][0])
            && (strpos($json['errors'][0]['message'], 'Syntax Error') === 0 || !$ignoreErrors)
        ) {
            if (isset($json['errors'][0]['debugMessage'])) {
                throw new Exception('GraphQL Error: ' . $json['errors'][0]['debugMessage'] . ' - Query was: ' . $query);
            }
            throw new Exception('GraphQL Error: ' . $json['errors'][0]['message'] . ' - Query was: ' . $query);
        }
    }

    /**
     * @param Model $model
     * @throws Exception
     */
    public static function assertModelEqualsDatabase(Model $model): void
    {
        $compareModel = null;
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            $model->attributesToArray();
            $compareModel = $model::queryForMutations($model->attributesToArray())->first();
        } else {
            if (empty($model->id)) {
                throw new Exception('Id is not set in model!');
            }
            $compareModel = $model::find($model->id);
        }
        foreach (array_diff($model->getFillable(), $model->getHidden()) as $field) {
            if ($field === 'tenant_id') {
                continue;
            }
            self::assertEquals(
                $model->$field,
                $compareModel->$field,
                get_class($model) . '->' . $field . ' database value:'
            );
        }
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function creationErrorTest(string $classname): void
    {
        $model = factory($classname)->make();
        $shortClassname = 'create' . $this->getShortClassname($classname);
        $fields = array_diff($model->getFillable(), $this->getSelect($model), ['tenant_id']);
        $key = array_pop($fields);
        if (is_null($key)) {
            // fallback for relations that are purely foreign_ids which are in select
            $fields = $this->getSelect($model);
            $key = array_pop($fields);
        }
        $query = 'mutation {' . $shortClassname . '(';
        $query .= $this->createFieldFromCasts($model, $key) . ' ';
        $query .= ') { ' . implode(', ', $this->getSelect($model)) . ' } }';
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query, true);
        self::assertGraphQlError($response);
    }

    /**
     * @param TestResponse $response
     * @param string|null $message
     */
    protected static function assertGraphQlError(TestResponse $response, string $message = null): void
    {
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'errors' => []
            ]
        );
        if (!is_null($message)) {
            $response->assertJson(
                [
                    'errors' => [
                        [
                            'message' => $message
                        ]
                    ]
                ]
            );
        }
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function updateTest(string $classname): void
    {
        $shortClassname = 'update' . $this->getShortClassname($classname);
        $model = $classname::first();
        $new = factory($classname)->make();
        foreach ($model->getFillable() as $field) {
            if ($field === 'tenant_id' || in_array($field, $this->getSelect($model), true)) {
                continue;
            }
            $model->$field = $new->$field;
        }
        [$query, $jsonStructure] = $this->createMutation(
            $shortClassname,
            $model,
            !in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)
        );
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        self::assertModelEqualsDatabase($model);
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function updateErrorTest(string $classname): void
    {
        $model = factory($classname)->make();
        $shortClassname = 'update' . $this->getShortClassname($classname);
        $query = 'mutation {' . $shortClassname . '(';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            foreach ($this->getSelect($model) as $key) {
                $query .= $this->createFieldFromCasts($model, $key) . ' ';
            }
        } else {
            $query .= 'id:1';
        }
        $query .= ') { ' . implode(', ', $this->getSelect($model)) . ' } }';
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query, true);
        self::assertGraphQlError($response);
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function deletionTest(string $classname): void
    {
        $model = $classname::first();
        $shortClassname = 'delete' . $this->getShortClassname($classname);
        [$query, $json] = $this->createDeletionQuery($shortClassname, $model);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertStatus(200);
        $response->assertJsonStructure($json);
        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model), true)) {
            $this->assertSoftDeleted($model);
        } else {
            $this->assertDeleted($model);
        }
    }

    /**
     * @param string $name
     * @param Model $model
     * @return array
     */
    private function createDeletionQuery(string $name, Model $model): array
    {
        $select = $this->getSelect($model);
        $query = 'mutation {' . $name . '(';
        $query .= implode(', ', $this->getFindBy($model));
        $query .= ') { ' . implode(', ', $select) . ' } }';
        $json = [
            'data' => [
                $name => $select
            ]
        ];
        return [$query, $json];
    }

    /**
     * @param Model $model
     * @return string[]
     */
    private function getFindBy(Model $model): array
    {
        $find = [];
        foreach ($this->getSelect($model) as $field) {
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
     * @param string $classname
     * @throws Exception
     */
    protected function deletionErrorTest(string $classname): void
    {
        $model = factory($classname)->make();
        $model->id = 1;
        $shortClassname = 'delete' . $this->getShortClassname($classname);
        [$query, $json] = $this->createDeletionQuery($shortClassname, $model);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query, true);
        $response->assertStatus(200);
        $json = [
            'data' => [
                $shortClassname => null
            ]
        ];
        $response->assertJson($json);
        $response->assertJsonMissing(
            [
                'errors' => [
                    [
                        'message' => 'Model not found.'
                    ]
                ]
            ]
        );
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function listTest(string $classname): void
    {
        $compareModel = $classname::first();
        $shortClassname = lcfirst(Str::plural($this->getShortClassname($classname)));
        [$query, $jsonStructure] = $this->createListQuery($shortClassname, $compareModel);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        $this->checkDataRows($classname, $response->json('data')[$shortClassname]['data']);
    }

    /**
     * @param string $name
     * @param Model $model
     * @param string|null $foreignKey
     * @return array
     */
    private function createListQuery(string $name, Model $model, string $foreignKey = null): array
    {
        $query = '{ ' . lcfirst($name);
        if (!is_null($foreignKey)) {
            $query .= '(' . $foreignKey . ': ' . $model->id . ')';
        }
        $query .= ' {data';

        $fields = array_diff($model->getFillable(), ['tenant_id'], $model->getHidden());
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            $fields[] = 'id';
        }
        $query .= '{' . implode(' ', $fields) . '}}';
        $query .= '}';
        $json = [
            'data' => [
                $name // ['data' => [$fields]]
            ]
        ];
        return [$query, $json];
    }

    /**
     * @param string $classname
     * @param array $data
     * @throws Exception
     */
    private function checkDataRows(string $classname, array $data): void
    {
        foreach ($data as $row) {
            $model = new $classname();
            $model->fill($row);
            if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
                $model->id = $row['id'];
            }
            self::assertModelEqualsDatabase($model);
        }
    }

    /**
     * @param string $classname
     * @param string $foreignKey
     * @param string $postFix
     * @throws Exception
     */
    protected function listByForeignKeyTest(string $classname, string $foreignKey, string $postFix = ''): void
    {
        $compareModel = $classname::first();
        $shortClassname = lcfirst(Str::plural($this->getShortClassname($classname))) . $postFix;
        [$query, $jsonStructure] = $this->createListQuery($shortClassname, $compareModel, $foreignKey);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertStatus(200);
        $response->assertJsonStructure($jsonStructure);
        $this->checkDataRows($classname, $response->json('data')[$shortClassname]['data']);
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function readTest(string $classname): void
    {
        $compareModel = $classname::first();
        $shortClassname = lcfirst($this->getShortClassname($classname));
        [$query, $jsonStructure] = $this->createQuery($shortClassname, $compareModel);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query);
        $response->assertJsonStructure($jsonStructure);
        $model = new $classname();
        $model->fill($response->json('data')[$shortClassname]);
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            $model->id = $compareModel->id;
        }
        self::assertModelEqualsDatabase($model);
    }

    /**
     * @param string $name
     * @param Model $model
     * @return array
     */
    private function createQuery(string $name, Model $model): array
    {
        $query = '{ ' . $name . '(';
        $query .= implode(', ', $this->getFindBy($model)) . ')';
        $fields = array_diff($model->getFillable(), ['tenant_id'], $model->getHidden());
        $query .= '{' . implode(' ', $fields) . '}}';
        $json = [
            'data' => [
                $name => $fields
            ]
        ];
        return [$query, $json];
    }

    /**
     * @param string $classname
     * @throws Exception
     */
    protected function readErrorTest(string $classname): void
    {
        $compareModel = factory($classname)->make();
        $compareModel->id = 1;
        $shortClassname = lcfirst($this->getShortClassname($classname));
        [$query, $jsonStructure] = $this->createQuery($shortClassname, $compareModel);
        $response = $this->jwt()->graphQL($query);
        $this->debug($response, $query, true);
        $response->assertJson(
            [
                'data' => [
                    $shortClassname => null
                ]
            ]
        );
    }

}
