<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

class GenerateMigrationsFromModels extends Command
{
    protected $signature = 'make:migrations-from-models';
    protected $description = 'Generate migration files based on eloquent models';

    public function handle()
    {
        $modelsPath = app_path('Models');
        $files = File::allFiles($modelsPath);

        foreach ($files as $index => $file) {
            $class = 'App\\Models\\' . str_replace('/', '\\', $file->getRelativePathname());
            $class = str_replace('.php', '', $class);

            if (class_exists($class) && is_subclass_of($class, Model::class)) {
                $this->generateMigration($class, $index);
            }
        }

        $this->info('Migrations generated successfully.');
    }

    protected function generateMigration($class, $index)
    {
        $model = new $class;
        $table = $model->getTable();
        $fillable = $model->getFillable();
        $casts = $model->getCasts();
        
        $columns = [];
        $columns[] = "            \$table->id();";
        foreach ($fillable as $field) {
            $type = 'string';
            $params = "('{$field}')";
            $modifiers = "";

            if (isset($casts[$field])) {
                $cast = $casts[$field];
                if (Str::startsWith($cast, 'decimal')) {
                    $type = "decimal";
                    $parts = explode(':', $cast);
                    if(isset($parts[1])) {
                        $params = "('{$field}', 15, {$parts[1]})";
                    } else {
                        $params = "('{$field}', 15, 2)";
                    }
                } elseif (in_array($cast, ['int', 'integer'])) {
                    $type = "integer";
                } elseif (in_array($cast, ['bool', 'boolean'])) {
                    $type = "boolean";
                } elseif (in_array($cast, ['date', 'datetime'])) {
                    $type = $cast;
                }
            } else {
                if (Str::endsWith($field, '_id')) {
                    $type = "foreignId";
                } elseif (Str::startsWith($field, 'is_') || Str::startsWith($field, 'has_')) {
                    $type = "boolean";
                    $modifiers .= "->default(false)";
                } elseif (in_array($field, ['status', 'type'])) {
                    $type = "string";
                } elseif (Str::endsWith($field, '_at')) {
                    $type = "timestamp";
                } elseif ($field === 'amount' || Str::endsWith($field, '_amount') || Str::endsWith($field, 'balance')) {
                    $type = "decimal";
                    $params = "('{$field}', 15, 2)";
                }
            }

            if (!Str::endsWith($field, '_id') && empty($modifiers)) {
                $modifiers .= "->nullable()";
            } elseif ($type === 'decimal' && strpos($modifiers, 'nullable') === false) {
                // Ensure decimals are nullable by default if not strictly constrained
                $modifiers .= "->nullable()";
            }

            $columns[] = "            \$table->{$type}{$params}{$modifiers};";
        }
        
        $columns[] = "            \$table->timestamps();";


        $migrationName = 'create_' . $table . '_table';
        // Prefix with some number to avoid conflict and keep order
        $prefix = date('Y_m_d_His', strtotime("+" . $index . " seconds"));
        $fileName = $prefix . '_' . $migrationName . '.php';
        $path = database_path('migrations/' . $fileName);
        
        $content = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration\n{\n    public function up(): void\n    {\n        Schema::create('{$table}', function (Blueprint \$table) {\n";
        $content .= implode("\n", $columns);
        $content .= "\n        });\n    }\n\n    public function down(): void\n    {\n        Schema::dropIfExists('{$table}');\n    }\n};\n";
        
        File::put($path, $content);
        $this->info("Created: " . $fileName);
    }
}
