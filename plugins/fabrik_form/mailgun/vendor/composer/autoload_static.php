<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd0a95588a90e3ff941631c85a41fc966
{
    public static $files = [
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'ddc0a4d7e61c0286f0f8593b1903e894' => __DIR__ . '/..' . '/clue/stream-filter/src/functions.php',
        '8cff32064859f4559445b89279f3199c' => __DIR__ . '/..' . '/php-http/message/src/filters.php',
    ];

    public static $prefixLengthsPsr4 = [
        'W' =>
            [
                'Webmozart\\Assert\\' => 17,
            ],
        'S' =>
            [
                'Symfony\\Component\\OptionsResolver\\' => 34,
            ],
        'P' =>
            [
                'Psr\\Http\\Message\\' => 17,
            ],
        'H' =>
            [
                'Http\\Promise\\'                  => 13,
                'Http\\Message\\MultipartStream\\' => 29,
                'Http\\Message\\'                  => 13,
                'Http\\Discovery\\'                => 15,
                'Http\\Client\\Curl\\'             => 17,
                'Http\\Client\\Common\\'           => 19,
                'Http\\Client\\'                   => 12,
            ],
        'G' =>
            [
                'GuzzleHttp\\Psr7\\' => 16,
            ],
        'C' =>
            [
                'Clue\\StreamFilter\\' => 18,
            ],
    ];

    public static $prefixDirsPsr4 = [
        'Webmozart\\Assert\\'                   =>
            [
                0 => __DIR__ . '/..' . '/webmozart/assert/src',
            ],
        'Symfony\\Component\\OptionsResolver\\' =>
            [
                0 => __DIR__ . '/..' . '/symfony/options-resolver',
            ],
        'Psr\\Http\\Message\\'                  =>
            [
                0 => __DIR__ . '/..' . '/psr/http-message/src',
            ],
        'Http\\Promise\\'                       =>
            [
                0 => __DIR__ . '/..' . '/php-http/promise/src',
            ],
        'Http\\Message\\MultipartStream\\'      =>
            [
                0 => __DIR__ . '/..' . '/php-http/multipart-stream-builder/src',
            ],
        'Http\\Message\\'                       =>
            [
                0 => __DIR__ . '/..' . '/php-http/message/src',
                1 => __DIR__ . '/..' . '/php-http/message-factory/src',
            ],
        'Http\\Discovery\\'                     =>
            [
                0 => __DIR__ . '/..' . '/php-http/discovery/src',
            ],
        'Http\\Client\\Curl\\'                  =>
            [
                0 => __DIR__ . '/..' . '/php-http/curl-client/src',
            ],
        'Http\\Client\\Common\\'                =>
            [
                0 => __DIR__ . '/..' . '/php-http/client-common/src',
            ],
        'Http\\Client\\'                        =>
            [
                0 => __DIR__ . '/..' . '/php-http/httplug/src',
            ],
        'GuzzleHttp\\Psr7\\'                    =>
            [
                0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
            ],
        'Clue\\StreamFilter\\'                  =>
            [
                0 => __DIR__ . '/..' . '/clue/stream-filter/src',
            ],
    ];

    public static $prefixesPsr0 = [
        'M' =>
            [
                'Mailgun' =>
                    [
                        0 => __DIR__ . '/..' . '/mailgun/mailgun-php/src',
                    ],
            ],
    ];

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader)
        {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd0a95588a90e3ff941631c85a41fc966::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd0a95588a90e3ff941631c85a41fc966::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd0a95588a90e3ff941631c85a41fc966::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
