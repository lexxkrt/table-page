<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86debdb8176b862e2bfebd7e2d87c392
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lexxkrt\\TablePage\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lexxkrt\\TablePage\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit86debdb8176b862e2bfebd7e2d87c392::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit86debdb8176b862e2bfebd7e2d87c392::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit86debdb8176b862e2bfebd7e2d87c392::$classMap;

        }, null, ClassLoader::class);
    }
}
