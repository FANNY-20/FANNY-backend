<?php

namespace Support;

use Illuminate\Foundation\Application as LaravelApplication;

class BaseApplication extends LaravelApplication
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $namespace = 'App\\';

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @param string $path
     */
    public function path($path = ''): string
    {
        return $this->basePath . \DIRECTORY_SEPARATOR . 'app/App' . ($path ? \DIRECTORY_SEPARATOR . $path : $path);
    }
}
