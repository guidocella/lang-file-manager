<?php

namespace GuidoCella;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class LangFileManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config/lang_file_manager.php' => config_path('lang_file_manager.php')], 'lang-file-manager');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lang-file-manager');


        /**
         * Store an array in a config or lang file.
         */
        File::macro('putArray', function (string $path, array $data) {
            return $this->put("$path.php", "<?php\n\nreturn " . var_export($data, true) . ";\n");
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lang_file_manager.php', 'lang_file_manager');
    }
}
