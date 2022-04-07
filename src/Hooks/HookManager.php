<?php

namespace App\Hooks;

use App\Hooks\Action\Action;
use App\Hooks\Filter\Filter;
use App\Traits\SingletonTrait;
use ReflectionClass;

class HookManager
{

    use SingletonTrait;

    /**
     * Autoload hook classes in path recursively
     *
     * @param string $path
     * @return void
     */
    private function loadClassesInPath(string $path): void
    {
        $files = glob("{$path}/*.php");
        natcasesort($files);

        foreach ($files as $file) {
            require_once $file;
        }

        if ($paths = glob("$path/*", GLOB_ONLYDIR)) {
            array_map(fn($path) => $this->loadClassesInPath($path), $paths);
        }
    }

    /**
     * Register hooks
     *
     * @throws \ReflectionException
     */
    public function registerHooks(): void
    {
        $this->loadClassesInPath(__DIR__);

        foreach (get_declared_classes() as $class) {
            if (
                (
                    is_subclass_of($class, Filter::class) === false
                    && is_subclass_of($class, Action::class) === false
                )
                || (new ReflectionClass($class))->isAbstract()
            ) {
                continue;
            }

            (new $class)->register();
        }
    }
}
