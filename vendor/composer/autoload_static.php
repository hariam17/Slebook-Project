<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9c7ec0c4836b6d2b3965a5af8c63bb8e
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit9c7ec0c4836b6d2b3965a5af8c63bb8e::$classMap;

        }, null, ClassLoader::class);
    }
}