<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0abdc5a38e24896478895a5a5ea10e29
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        'fc73bab8d04e21bcdda37ca319c63800' => __DIR__ . '/..' . '/mikecao/flight/flight/autoload.php',
        '5b7d984aab5ae919d3362ad9588977eb' => __DIR__ . '/..' . '/mikecao/flight/flight/Flight.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Cache\\' => 10,
        ),
        'O' => 
        array (
            'OpenApi\\' => 8,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'D' => 
        array (
            'Doctrine\\Deprecations\\' => 22,
            'Doctrine\\Common\\Lexer\\' => 22,
            'Doctrine\\Common\\Annotations\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'OpenApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/zircote/swagger-php/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Doctrine\\Deprecations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/deprecations/lib/Doctrine/Deprecations',
        ),
        'Doctrine\\Common\\Lexer\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/lexer/src',
        ),
        'Doctrine\\Common\\Annotations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/annotations/lib/Doctrine/Common/Annotations',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0abdc5a38e24896478895a5a5ea10e29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0abdc5a38e24896478895a5a5ea10e29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0abdc5a38e24896478895a5a5ea10e29::$classMap;

        }, null, ClassLoader::class);
    }
}
