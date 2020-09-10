<?php


namespace HelloCash\HelloMicroservice\Console;


use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MakeGraphQlSchemaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:graphqlschema
                            {model : classname of model to generate schema for}
                            {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create basic GraphQL schema template from existing model';

    protected $classname = '';
    protected $model = null;
    protected $primary = '';


    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $shortClassname = $this->argument('model');
        $this->classname = $shortClassname;
        $classname = '\\App\\'.$shortClassname;
        if (!class_exists($classname)) {
            $this->error('Model "'.$shortClassname.'" not found.');
            return;
        }
        /** @var Model $model */
        $model = new $classname();
        if (!$model instanceof Model) {
            $this->error('Class "'.$shortClassname.'" is not a Model.');
            return;
        }
        $this->model = $model;

        $path = base_path('graphql');
        $file = $path . '/' . lcfirst($shortClassname) . '.graphql';
        if (file_exists($file) && !$this->option('overwrite')) {
            $this->error('Schema "' . lcfirst($shortClassname) . '.graphql" already exists. Use --overwrite to force creation.');
            return;
        }

        $this->primary = $this->getPrimaryFields($model, ' @eq');
        $schema = 'extend type Query {' . PHP_EOL;
        $schema .= $this->buildListQuery();
        $schema .= $this->buildFindQuery();

        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model), true)) {
            $this->primary = $this->getPrimaryFields($model);
        }
        $schema .= '}' . PHP_EOL . PHP_EOL . 'extend type Mutation {' . PHP_EOL;
        $schema .= $this->buildCreateMutation();
        $schema .= $this->buildUpdateMutation();
        $schema .= $this->buildDeleteMutation();
        $schema .= '}' . PHP_EOL . PHP_EOL;
        $schema .= $this->buildTypeDefinition();

        if (!file_exists($file)) {
            $schemaFile = $path . '/schema.graphql';
            file_put_contents($schemaFile, '#import ' .lcfirst($shortClassname) . '.graphql'. PHP_EOL,FILE_APPEND);
        }
        file_put_contents($file, $schema);
    }

    /**
     * @return string
     */
    protected function buildListQuery(): string
    {
        return '    ' . Str::plural(lcfirst($this->classname)) . ': [' . $this->classname . '] @paginate(defaultCount: 10) @guard' . PHP_EOL;
    }

    /**
     * @return string
     */
    protected function buildFindQuery(): string
    {
        return '    ' . lcfirst($this->classname) . '(' . $this->primary . '): ' . $this->classname . ' @find @guard' . PHP_EOL;
    }

    /**
     * @return string
     */
    protected function buildCreateMutation(): string
    {
        $schema = '    create' . $this->classname . '(' . PHP_EOL;
        $schema .= $this->getFields($this->model);
        $schema .= '    ): ' . $this->classname . '! @create @guard' . PHP_EOL;
        return $schema;
    }

    /**
     * @return string
     */
    protected function buildUpdateMutation(): string
    {
        $schema = '    update' . $this->classname . '(' . PHP_EOL;
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($this->model), true)) {
            $schema .= '        ' . $this->primary . PHP_EOL;
        }

        $schema .= $this->getFields($this->model);
        $schema .= '    ): ' . $this->classname . '! ';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($this->model), true)) {
            $schema .= '@field(resolver: "UpdateMutation")';
        } else {
            $schema .= '@update';
        }
        $schema .= ' @guard' . PHP_EOL;
        return $schema;
    }

    /**
     * @return string
     */
    protected function buildDeleteMutation(): string
    {
        $schema = '    delete' . $this->classname . '(' . $this->model . '): ' . $this->classname . ' ';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($this->model), true)) {
            $schema .= '@field(resolver: "DeleteMutation")';
        } else {
            $schema .= '@delete';
        }
        $schema .= ' @guard' . PHP_EOL;
        return $schema;
    }

    /**
     * @return string
     */
    protected function buildTypeDefinition(): string
    {
        $schema = 'type ' . $this->classname . ' {' . PHP_EOL;
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($this->model), true)) {
            $schema .= '        id: ID!' . PHP_EOL;
        }
        $schema .= $this->getFields($this->model, true);
        $schema .= '}';
        return $schema;
    }


    /**
     * @param Model $model
     * @param bool $all
     * @param string $prefix
     * @return string
     */
    protected function getFields(Model $model, bool $all = false, string $prefix = '        '): string
    {
        $schema = '';
        foreach ($model->getFillable() as $field) {
            if ($field === 'tenant_id') {
                continue;
            }
            $schema .= $this->getSingleField($field, $model, $prefix);
        }
        if ($all && $model->timestamps) {
            $schema .= $prefix . 'created_at: DateTime!' . PHP_EOL;
            $schema .= $prefix . 'updated_at: DateTime!' . PHP_EOL;
        }
        return $schema;
    }


    /**
     * @param Model $model
     * @param string $postfix
     * @return string
     */
    protected function getPrimaryFields(Model $model, $postfix = ''): string
    {
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $parts = [];
            foreach ($model->getPrimaryKeyFields() as $field) {
                $parts[] = $this->getSingleField($field, $model, '', $postfix);
            }
            return implode(' ', $parts);
        }
        return $model->getKeyName() . ': ' . ucfirst($model->getKeyType()) . '!' . $postfix;
    }

    protected function getSingleField(string $field, Model $model, string $prefix = '        ', string $postfix = PHP_EOL): string
    {
        $casts = $model->getCasts();
        $inject = '';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))
            && in_array($field, $model->getPrimaryKeyFields(), true)) {
            $inject = '!';
        }
        if ($field === 'country_code') {
            return $prefix . $field . ': CountryCode!' . $postfix;
        }
        switch ($casts[$field] ?? 'string') {
            case 'string':
            default:
                return $prefix . $field . ': String' . $inject . $postfix;
            case 'integer':
            case 'timestamp':
                return $prefix . $field . ': Int' . $inject . $postfix;
            case 'real':
            case 'float':
            case 'double':
                return $prefix . $field . ': Float' . $inject . $postfix;
            case 'boolean':
                return $prefix . $field . ': Boolean' . $inject . $postfix;
            case 'date':
                return $prefix . $field . ': Date' . $inject . $postfix;
            case 'datetime':
                return $prefix . $field . ': DateTime' . $inject . $postfix;
        }
    }

}
