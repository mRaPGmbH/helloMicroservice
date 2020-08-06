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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $shortClassname = $this->argument('model');
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
        $path = base_path('graphql');
        $file = $path . '/' . lcfirst($shortClassname) . '.graphql';
        if (file_exists($file) && !$this->option('overwrite')) {
            $this->error('Schema "' . lcfirst($shortClassname) . '.graphql" already exists. Use --overwrite to force creation.');
            return;
        }

        $primary = $this->getPrimaryFields($model, ' @eq');

        $schema = 'extend type Query {' . PHP_EOL;
        $schema .= '    ' . Str::plural(lcfirst($shortClassname)) . ': [' . $shortClassname . '] @paginate(defaultCount: 10) @guard' . PHP_EOL;
        $schema .= '    ' . lcfirst($shortClassname) . '(' . $primary . '): ' . $shortClassname . ' @find @guard' . PHP_EOL;

        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $primary = $this->getPrimaryFields($model);
        }

        $schema .= '}' . PHP_EOL . PHP_EOL . 'extend type Mutation {' . PHP_EOL;
        $schema .= '    create' . $shortClassname . '(' . PHP_EOL;
        $schema .= $this->getFields($model);
        $schema .= '    ): ' . $shortClassname . '! @create @guard' . PHP_EOL;
        $schema .= '    update' . $shortClassname . '(' . PHP_EOL;
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $schema .= '        ' . $primary . PHP_EOL;
        }

        $schema .= $this->getFields($model);
        $schema .= '    ): ' . $shortClassname . '! ';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $schema .= '@field(resolver: "UpdateMutation")';
        } else {
            $schema .= '@update';
        }
        $schema .= ' @guard' . PHP_EOL;


        $schema .= '    delete' . $shortClassname . '(' . $primary . '): ' . $shortClassname . ' ';
        if (in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $schema .= '@field(resolver: "DeleteMutation")';
        } else {
            $schema .= '@delete';
        }
        $schema .= ' @guard' . PHP_EOL;

        $schema .= '}' . PHP_EOL . PHP_EOL . 'type ' . $shortClassname . ' {' . PHP_EOL;
        if (!in_array('HelloCash\HelloMicroservice\Traits\CustomMutations', class_uses($model))) {
            $schema .= '        id: ID!' . PHP_EOL;
        }
        $schema .= $this->getFields($model, true);
        $schema .= '}';

        if (!file_exists($file)) {
            $schemaFile = $path . '/schema.graphql' . PHP_EOL;
            file_put_contents($schemaFile, '#import ' .lcfirst($shortClassname) . '.graphql',FILE_APPEND);
        }
        file_put_contents($file, $schema);
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
