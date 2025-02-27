<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd612c99a47c265b4f1df6e309458391f
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Cabir\\Php\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cabir\\Php\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd612c99a47c265b4f1df6e309458391f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd612c99a47c265b4f1df6e309458391f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd612c99a47c265b4f1df6e309458391f::$classMap;

        }, null, ClassLoader::class);
    }
}
