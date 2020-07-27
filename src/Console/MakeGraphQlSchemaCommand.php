<?php


namespace HelloCash\HelloMicroservice\Console;


use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

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

        $primary =  $model->getKeyName() . ': ' . ucfirst($model->getKeyType());

        $schema = 'type Query {' . PHP_EOL;
        $schema .= '    ' . lcfirst($shortClassname) . 's: [' . $shortClassname . '!] @paginate(defaultCount: 10) @guard' . PHP_EOL;
        $schema .= '    ' . lcfirst($shortClassname) . '(' . $primary . '! @eq): ' . $shortClassname . '! @find @guard';

        $schema .= '}' . PHP_EOL . PHP_EOL . 'type Mutation {' . PHP_EOL;
        $schema .= '    create' . $shortClassname . '(' . PHP_EOL;
        $schema .= $this->getFields($model);
        $schema .= '    ): ' . $shortClassname . '! @create @guard' . PHP_EOL;
        $schema .= '    update' . $shortClassname . '(' . PHP_EOL;
        $schema .= '        ' . $primary . '! @eq' . PHP_EOL;
        $schema .= $this->getFields($model);
        $schema .= '    ): ' . $shortClassname . '! @update @guard' . PHP_EOL;
        $schema .= '    delete' . $shortClassname . '(' . $primary . '! @eq): ' . $shortClassname . '! @delete @guard' . PHP_EOL;

        $schema .= '}' . PHP_EOL . PHP_EOL . 'type ' . $shortClassname . ' {' . PHP_EOL;
        if ($model->getKeyName() === 'id') {
            $schema .= '        id: ID!' . PHP_EOL;
        } else {
            $schema .= '        ' . $primary . '!' . PHP_EOL;
        }
        $schema .= $this->getFields($model, true);
        $schema .= '}';

        dd($schema);
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
        $casts = $model->getCasts();
        foreach ($model->getFillable() as $field) {
            switch ($casts[$field] ?? 'string') {
                case 'string':
                default:
                    $schema .= $prefix . $field . ': String' . PHP_EOL;
                    break;
                case 'integer':
                case 'timestamp':
                    $schema .= $prefix . $field . ': Int' . PHP_EOL;
                    break;
                case 'real':
                case 'float':
                case 'double':
                    $schema .= $prefix . $field . ': Float' . PHP_EOL;
                    break;
                case 'boolean':
                    $schema .= $prefix . $field . ': Boolean' . PHP_EOL;
                    break;
                case 'date':
                    $schema .= $prefix . $field . ': Date' . PHP_EOL;
                    break;
                case 'datetime':
                    $schema .= $prefix . $field . ': DateTime' . PHP_EOL;
                    break;
            }
        }

        if ($all) {
            if ($model->timestamps) {
                $schema .= $prefix . 'created_at: DateTime!' . PHP_EOL;
                $schema .= $prefix . 'updated_at: DateTime!' . PHP_EOL;
            }
        }
        return $schema;
    }

}
