<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd348afc70bccd488b37d7709bf69e118
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Includes\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd348afc70bccd488b37d7709bf69e118::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd348afc70bccd488b37d7709bf69e118::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
