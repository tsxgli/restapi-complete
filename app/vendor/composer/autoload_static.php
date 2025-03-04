<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a5b000460c064a9c32fe6ac415cfb09
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Services\\' => 9,
        ),
        'R' => 
        array (
            'Routers\\' => 8,
            'Repositories\\' => 13,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'Routers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/routers',
        ),
        'Repositories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/repositories',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a5b000460c064a9c32fe6ac415cfb09::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a5b000460c064a9c32fe6ac415cfb09::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2a5b000460c064a9c32fe6ac415cfb09::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2a5b000460c064a9c32fe6ac415cfb09::$classMap;

        }, null, ClassLoader::class);
    }
}
