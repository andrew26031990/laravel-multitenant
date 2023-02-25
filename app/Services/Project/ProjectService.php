<?php

namespace App\Services\Project;


use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionObject;
use ReflectionType;
use Throwable;
use Illuminate\Container\Container;
use DB;
use Illuminate\Database\Eloquent\Model;
use Schema;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\ContextFactory;



class ProjectService
{

    public $exclude = [
        'oauth_access_tokens',
        'oauth_auth_codes',
        'oauth_clients',
        'oauth_personal_access_clients',
        'oauth_refresh_tokens',
        'failed_jobs',
        'migrations',
        'media',
        'personal_access_tokens'
    ];

    protected const RELATION_TYPES = [
        'hasMany' => HasMany::class,
        'hasManyThrough' => HasManyThrough::class,
        'hasOneThrough' => HasOneThrough::class,
        'belongsToMany' => BelongsToMany::class,
        'hasOne' => HasOne::class,
        'belongsTo' => BelongsTo::class,
        'morphOne' => MorphOne::class,
        'morphTo' => MorphTo::class,
        'morphMany' => MorphMany::class,
        'morphToMany' => MorphToMany::class,
        'morphedByMany' => MorphToMany::class,
    ];

    protected $write = false;
    protected $write_mixin = false;
    protected $dateClass;
    protected $foreignKeyConstraintsColumns = [];


    public function getTables()
    {
        $tables = collect(Schema::getAllTables());
        $dbName = DB::connection()->getDatabaseName();
        $tables = $tables->mapWithKeys(function ($item) use ($dbName) {
            $key = "Tables_in_" . $dbName;
            return [
                $item->$key => [
                    'columns' => collect(Schema::getColumnListing($item->$key))
                        ->map(function ($itemColumn) use ($item, $key) {
                            return [
                                'name' => $itemColumn,
                                'type' => Schema::getColumnType($item->$key, $itemColumn),
                            ];
                        }),
                ]
            ];
        })
            ->filter(function ($item, $table) {
                $columns = collect($item['columns']);
                return (($columns->whereIn('name', ['id'])->count() || stripos($table, '_translations')) && !in_array($table, $this->exclude));
            });

        return $tables;
    }

    public function getRoutes()
    {
        return collect(\Route::getRoutes())->filter(function ($item) {
            return str_contains($item->uri, 'v1');
        })->values();
    }

    public function getModels()
    {
        $models =  collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf(
                    '\%s%s',
                    optional(Container::getInstance())->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\')
                );
                return $class;
            })
            ->filter(function ($class) {
                $valid = false;
                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }
                return $valid;
            })
            ->mapWithKeys(function ($item) {
                return [(class_basename($item)) => $item];
            });

        return $models;
    }

    public function resourceTemplateGenerate($model)
    {
        $resourceStr = '' . PHP_EOL;

        $fields = $this->getPropertiesFromModel($model);

        foreach ($fields as $field) {
            $resourceStr .= '               \'' . $field['name'] . '\' => $this->' . $field['name'] . ',' . PHP_EOL;
        }

        $relations = $this->getPropertiesFromModelMethods($model);

        foreach ($relations as $relation) {
            $resourceStr .= in_array($relation['relation_type'], ['array', 'object']) ?   '                 \''
                . $relation['method'] . '\' => ' . ($relation['relation_type'] == 'object' ? 'new' : '') . ' '
                . $relation['class_name'] . 'Resource' . ($relation['relation_type'] == 'array' ? '::collection' : '')
                . '($this->whenLoaded(\'' . $relation['method'] . '\')),' . PHP_EOL : '';
        }

        return $resourceStr;
    }



    public function swaggerParamsGeneratorFromModel($model, $namespace = '', $relationType = 'Resource')
    {


        $resourceStr = '
    /**';

        $fields = $this->getPropertiesFromModel($model);

        foreach ($fields as $field) {
            $resourceStr .=  "
    *  @OA\Property(
    *    property=\"" . $field['name'] . "\",
    *    type=\"" . $field['type'] . "\",
    *    example=\"\",
    *    description=\"" . $field['comment'] . "\"
    *  ) 
    *
    *" . PHP_EOL;
        }

        $relations = $this->getPropertiesFromModelMethods($model);

        foreach ($relations as $relation) {
            $resourceStr .=  "
      
    * 
    *  @OA\Property(
    *    property=\"" . $relation['method'] . "\",
    *    type=\"" . $relation['relation_type'] . "\",
    *    " . ($relation['relation_type'] == 'object' ? 'ref="#/components/schemas/' . $namespace . $relation['class_name'] . $relationType . '"' : '@OA\Items(ref="#/components/schemas/' . $namespace . $relation['class_name'] . $relationType . '")') . ",
    *    description=\"" . $relation['relation_type'] . "\"
    *  ) 
    *
    " . PHP_EOL;
        }

        $resourceStr .= '
    */';



        return $resourceStr;
    }

    public function swaggerParamsGeneratorFromTable($table_name)
    {
        $resourceStr = '
    /**';

        $fields = $this->getPropertiesFromTableName($table_name);

        foreach ($fields as $field) {
            $resourceStr .=  "
    
    *  @OA\Property(
    *    property=\"" . $field['name'] . "\",
    *    type=\"" . $field['type'] . "\",
    *    example=\"\",
    *    description=\"" . $field['comment'] . "\"
    *  ) 
    " . PHP_EOL;
        }
        $resourceStr .= '
    */';

        return $resourceStr;
    }

    public function getPropertiesFromTableName($table_name)
    {
        $database = DB::table($table_name)->getConnection()->getDatabaseName();

        $table = $table_name;
        $schema = optional(DB::table($table_name)->getConnection())->getDoctrineSchemaManager();
        $databasePlatform = $schema->getDatabasePlatform();
        $databasePlatform->registerDoctrineTypeMapping('enum', 'string');
        $customTypes = [];
        foreach ($customTypes as $yourTypeName => $doctrineTypeName) {
            try {
                if (!Type::hasType($yourTypeName)) {
                    Type::addType($yourTypeName, get_class(Type::getType($doctrineTypeName)));
                }
            } catch (DBALException $exception) {
                // $this->error("Failed registering custom db type \"$yourTypeName\" as \"$doctrineTypeName\"");
                throw $exception;
            }
            $databasePlatform->registerDoctrineTypeMapping($yourTypeName, $doctrineTypeName);
        }

        $columns = $schema->listTableColumns($table, $database);

        $relations = $schema->listTableForeignKeys($table, $database);

        foreach ($relations as $relation) {
            // dd($relation);
        }

        if (!$columns) {
            [];
        }

        $this->setForeignKeys($schema, $table);

        $cols = [];

        foreach ($columns as $keyColumn => $column) {

            $name = $column->getName();

            $type = $column->getType()->getName();

            $cols[$keyColumn] = [
                'original_type' => $type
            ];

            switch ($type) {
                case 'string':
                case 'text':
                case 'date':
                case 'time':
                case 'guid':
                case 'datetimetz':
                case 'datetime':
                case 'decimal':
                    $type = 'string';
                    break;
                case 'integer':
                case 'bigint':
                case 'smallint':
                    $type = 'integer';
                    break;
                case 'boolean':
                    $type = 'boolean';
                    break;
                    break;
                case 'float':
                    $type = 'float';
                    break;
                default:
                    $type = 'mixed';
                    break;
            }


            $comment = $column->getComment();


            $cols[$keyColumn]['name'] = $name;
            $cols[$keyColumn]['type'] = $type;
            $cols[$keyColumn]['comment'] = $comment;
            $cols[$keyColumn]['is_null'] = !$column->getNotnull();
        }

        return  $cols;
    }

    public function getPropertiesFromModel($model)
    {
        $database = $model->getConnection()->getDatabaseName();
        $table = $model->getConnection()->getTablePrefix() . $model->getTable();
        $schema = $model->getConnection()->getDoctrineSchemaManager();
        $databasePlatform = $schema->getDatabasePlatform();
        $databasePlatform->registerDoctrineTypeMapping('enum', 'string');
        $customTypes = [];
        foreach ($customTypes as $yourTypeName => $doctrineTypeName) {
            try {
                if (!Type::hasType($yourTypeName)) {
                    Type::addType($yourTypeName, get_class(Type::getType($doctrineTypeName)));
                }
            } catch (DBALException $exception) {
                // $this->error("Failed registering custom db type \"$yourTypeName\" as \"$doctrineTypeName\"");
                throw $exception;
            }
            $databasePlatform->registerDoctrineTypeMapping($yourTypeName, $doctrineTypeName);
        }

        $columns = $schema->listTableColumns($table, $database);

        if (!$columns) {
            return;
        }

        $this->setForeignKeys($schema, $table);

        $cols = [];

        foreach ($columns as $keyColumn => $column) {

            $name = $column->getName();
            if (in_array($name, $model->getDates())) {
                $type = $this->dateClass;
            } else {

                $type = $column->getType()->getName();

                $cols[$keyColumn] = [
                    'original_type' => $type
                ];

                switch ($type) {
                    case 'string':
                    case 'text':
                    case 'date':
                    case 'time':
                    case 'guid':
                    case 'datetimetz':
                    case 'datetime':
                    case 'decimal':
                        $type = 'string';
                        break;
                    case 'integer':
                    case 'bigint':
                    case 'smallint':
                        $type = 'integer';
                        break;
                    case 'boolean':
                        $type = 'boolean';
                        break;
                        break;
                    case 'float':
                        $type = 'float';
                        break;
                    default:
                        $type = 'mixed';
                        break;
                }
            }

            $comment = $column->getComment();


            $cols[$keyColumn]['name'] = $name;
            $cols[$keyColumn]['type'] = $type;
            $cols[$keyColumn]['comment'] = $comment;
            $cols[$keyColumn]['is_null'] = !$column->getNotnull();
        }

        return  $cols;
    }

    public function getPropertiesFromModelMethods($model)
    {
        $methods = get_class_methods($model);

        if ($methods) {
            sort($methods);
            $rels = [];
            foreach ($methods as $method) {
                $reflection = new \ReflectionMethod($model, $method);

                $type = $this->getReturnTypeFromReflection($reflection);
                $isAttribute = is_a($type, '\Illuminate\Database\Eloquent\Casts\Attribute', true);
                if (
                    !method_exists('Illuminate\Database\Eloquent\Model', $method)
                    && !Str::startsWith($method, 'get')
                ) {
                    if ($returnType = $reflection->getReturnType()) {
                        $type = $returnType instanceof ReflectionNamedType
                            ? $returnType->getName()
                            : (string)$returnType;
                    } else {

                        $type = "";
                    }

                    $file = new \SplFileObject($reflection->getFileName());
                    $file->seek($reflection->getStartLine() - 1);

                    $code = '';
                    while ($file->key() < $reflection->getEndLine()) {
                        $code .= $file->current();
                        $file->next();
                    }
                    $code = trim(preg_replace('/\s\s+/', '', $code));
                    $begin = strpos($code, 'function(');
                    $code = substr($code, $begin, strrpos($code, '}') - $begin + 1);
                    foreach ($this->getRelationTypes() as $relation => $impl) {
                        $search = '$this->' . $relation . '(';
                        if (stripos($code, $search) || ltrim($impl, '\\') === ltrim((string)$type, '\\')) {
                            //Resolve the relation's model to a Relation object.
                            $methodReflection = new \ReflectionMethod($model, $method);
                            $relationObj = Relation::noConstraints(function () use ($model, $method) {
                                try {
                                    return $model->$method();
                                } catch (Throwable $e) {
                                    // $this->warn(sprintf('Error resolving relation model of %s:%s() : %s', get_class($model), $method, $e->getMessage()));

                                    return null;
                                }
                            });
                            if ($relationObj instanceof Relation) {
                                $relatedModel = $this->getClassNameInDestinationFile(
                                    $model,
                                    get_class($relationObj->getRelated())
                                );



                                if (
                                    strpos(get_class($relationObj), 'Many') !== false ||
                                    ($this->getRelationReturnTypes()[$relation] ?? '') === 'many'
                                ) {

                                    $relateType = 'array';
                                } elseif (
                                    $relation === 'morphTo' ||
                                    ($this->getRelationReturnTypes()[$relation] ?? '') === 'morphTo'
                                ) {
                                    $relateType = 'morph';
                                } else {
                                    $relateType = 'object';
                                }

                                $rels[] = [
                                    'type' => $relation,
                                    'model' => $relatedModel,
                                    'class_name' => class_basename($relatedModel),
                                    'method' => $method,
                                    'relation_type' => $relateType
                                ];
                            }
                        }
                    }
                }
            }

            return $rels;
        }
    }

    protected function getClassNameInDestinationFile(object $model, string $className): string
    {
        $reflection = $model instanceof ReflectionClass
            ? $model
            : new ReflectionObject($model);

        $className = trim($className, '\\');
        $writingToExternalFile = !$this->write || $this->write_mixin;
        $classIsNotInExternalFile = $reflection->getName() !== $className;
        $forceFQCN = false;

        if (($writingToExternalFile && $classIsNotInExternalFile) || $forceFQCN) {
            return '\\' . $className;
        }

        $usedClassNames = $this->getUsedClassNames($reflection);
        return $usedClassNames[$className] ?? ('\\' . $className);
    }

    protected function getUsedClassNames(ReflectionClass $reflection): array
    {
        $namespaceAliases = array_flip((new ContextFactory())->createFromReflector($reflection)->getNamespaceAliases());
        $namespaceAliases[$reflection->getName()] = $reflection->getShortName();

        return $namespaceAliases;
    }

    protected function getRelationTypes(): array
    {
        $configuredRelations = [
            [
                'hasMany' => HasMany::class,
                'hasManyThrough' => HasManyThrough::class,
                'hasOneThrough' => HasOneThrough::class,
                'belongsToMany' => BelongsToMany::class,
                'hasOne' => HasOne::class,
                'belongsTo' => BelongsTo::class,
                'morphOne' => MorphOne::class,
                'morphTo' => MorphTo::class,
                'morphMany' => MorphMany::class,
                'morphToMany' => MorphToMany::class,
                'morphedByMany' => MorphToMany::class,
            ]
        ];
        return array_merge(self::RELATION_TYPES, array_keys($configuredRelations));
    }

    protected function getReturnTypeFromReflection(\ReflectionMethod $reflection): ?string
    {
        $returnType = $reflection->getReturnType();
        if (!$returnType) {
            return null;
        }

        $types = $this->extractReflectionTypes($returnType);

        $type = implode('|', $types);

        if ($returnType->allowsNull()) {
            $type .= '|null';
        }

        return $type;
    }

    protected function extractReflectionTypes(ReflectionType $reflection_type)
    {
        if ($reflection_type instanceof ReflectionNamedType) {
            $types[] = $this->getReflectionNamedType($reflection_type);
        } else {
            $types = [];
            foreach (optional($reflection_type)->getTypes() as $named_type) {
                if ($named_type->getName() === 'null') {
                    continue;
                }

                $types[] = $this->getReflectionNamedType($named_type);
            }
        }

        return $types;
    }

    protected function getReflectionNamedType(ReflectionNamedType $paramType): string
    {
        $parameterName = $paramType->getName();
        if (!$paramType->isBuiltin()) {
            $parameterName = '\\' . $parameterName;
        }

        return $parameterName;
    }

    protected function setForeignKeys($schema, $table)
    {
        foreach ($schema->listTableForeignKeys($table) as $foreignKeyConstraint) {
            foreach ($foreignKeyConstraint->getLocalColumns() as $columnName) {
                $this->foreignKeyConstraintsColumns[] = $columnName;
            }
        }
    }

    protected function getTypeInModel(object $model, ?string $type): ?string
    {
        if ($type === null) {
            return null;
        }

        if (class_exists($type)) {
            $type = $this->getClassNameInDestinationFile($model, $type);
        }

        return $type;
    }

    protected function getRelationReturnTypes(): array
    {
        return [];
    }
}
