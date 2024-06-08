<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitccf1388fbb4208330f010810967c6773
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pecee\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pecee\\' => 
        array (
            0 => __DIR__ . '/..' . '/pecee/simple-router/src/Pecee',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitccf1388fbb4208330f010810967c6773::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitccf1388fbb4208330f010810967c6773::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitccf1388fbb4208330f010810967c6773::$classMap;

        }, null, ClassLoader::class);
    }
}
