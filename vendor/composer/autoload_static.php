<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit928376f830f4d0af2fa0b1aaf1ef534e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit928376f830f4d0af2fa0b1aaf1ef534e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit928376f830f4d0af2fa0b1aaf1ef534e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit928376f830f4d0af2fa0b1aaf1ef534e::$classMap;

        }, null, ClassLoader::class);
    }
}
