<?php

namespace Support\IdeHelper;

use Domain\Geolocation\Models\Geolocation;
use Soyhuce\NextIdeHelper\Console\Bootstrapper;

class CustomColumnsBootstrapper implements Bootstrapper
{
    public function bootstrap(): void
    {
        (new Geolocation())->getConnection()
            ->getDoctrineConnection()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('geography', 'string');
    }
}
