<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe201c0c9ff8ad241131d996e615695d
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'charlesassets\\LaravelPerfectMoney\\' => 34,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Contracts\\Translation\\' => 30,
            'Symfony\\Component\\Translation\\' => 30,
        ),
        'R' => 
        array (
            'Razorpay\\Tests\\' => 15,
            'Razorpay\\Api\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'charlesassets\\LaravelPerfectMoney\\' => 
        array (
            0 => __DIR__ . '/..' . '/charlesassets/laravel-perfectmoney/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Contracts\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation-contracts',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Razorpay\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/tests',
        ),
        'Razorpay\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/nesbot/carbon/src',
    );

    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'UpdateHelper\\' => 
            array (
                0 => __DIR__ . '/..' . '/kylekatarnls/update-helper/src',
            ),
        ),
        'R' => 
        array (
            'Requests' => 
            array (
                0 => __DIR__ . '/..' . '/rmccue/requests/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe201c0c9ff8ad241131d996e615695d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe201c0c9ff8ad241131d996e615695d::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitbe201c0c9ff8ad241131d996e615695d::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbe201c0c9ff8ad241131d996e615695d::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
