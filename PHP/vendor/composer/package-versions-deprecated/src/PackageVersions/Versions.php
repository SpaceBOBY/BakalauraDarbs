<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'cakephp/core' => '4.2.8@bed4b6f09550909beea5440627d5a6ff85fb1934',
  'cakephp/utility' => '4.2.8@4259ae4154e639557af751ae719d58253a79282a',
  'composer/package-versions-deprecated' => '1.11.99.3@fff576ac850c045158a250e7e27666e146e78d18',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '2.13.2@8dd39d2ead4409ce652fd4f02621060f009ea5e4',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '2.0.3@9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'doctrine/migrations' => '3.2.1@818e31703b4fb353c0c23caa714273fc64efa675',
  'evenement/evenement' => 'v3.0.1@531bfb9d15f8aa57454f5f0285b18bec903b8fb7',
  'friendsofphp/proxy-manager-lts' => 'v1.0.5@006aa5d32f887a4db4353b13b5b5095613e0611f',
  'graham-campbell/result-type' => 'v1.0.2@84afea85c6841deeea872f36249a206e878a5de0',
  'indigophp/hash-compat' => 'v1.1.0@43a19f42093a0cd2d11874dff9d891027fc42214',
  'laminas/laminas-code' => '4.4.2@54251ab2b16c41c6980387839496b235f5f6e10b',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'paragonie/random_compat' => 'v9.99.100@996434e5492cb4c3edcb9168db6fbb1359ef965a',
  'phpoption/phpoption' => '1.8.0@5455cb38aed4523f99977c4a12ef19da4bfe2a28',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'react/cache' => 'v1.1.1@4bf736a2cccec7298bdf745db77585966fc2ca7e',
  'react/child-process' => 'v0.6.3@45e6e3a363e531ed1aafb58e3886c4561432a2a0',
  'react/dns' => 'v1.8.0@2a5a74ab751e53863b45fb87e1d3913884f88248',
  'react/event-loop' => 'v1.2.0@be6dee480fc4692cec0504e65eb486e3be1aa6f2',
  'react/filesystem' => 'v0.1.1@ddb11f9c1a9786898447f44cbb9be56af05e0d01',
  'react/http' => 'v1.5.0@8a0fd7c0aa74f0db3008b1e47ca86c613cbb040e',
  'react/mysql' => 'v0.5.5@39973a8d80a0479bc5a3cb102824afb9ccfb545f',
  'react/promise' => 'v2.8.0@f3cff96a19736714524ca0dd1d4130de73dbbbc4',
  'react/promise-stream' => 'v1.2.0@6384d8b76cf7dcc44b0bf3343fb2b2928412d1fe',
  'react/promise-timer' => 'v1.7.0@607dd79990e32fcb402cb0a176b4a4be12f97e7c',
  'react/socket' => 'v1.9.0@aa6e3f8ebcd6dec3ad1ee92a449b4cc341994001',
  'react/stream' => 'v1.2.0@7a423506ee1903e89f1e08ec5f0ed430ff784ae9',
  'ringcentral/psr7' => '1.3.0@360faaec4b563958b673fb52bbe94e37f14bc686',
  'symfony/console' => 'v5.3.7@8b1008344647462ae6ec57559da166c2bfa5e16a',
  'symfony/deprecation-contracts' => 'v2.4.0@5f38c8804a9e97d23e0c8d63341088cd8a22d627',
  'symfony/filesystem' => 'v5.3.4@343f4fe324383ca46792cae728a3b6e2f708fb32',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-intl-grapheme' => 'v1.23.1@16880ba9c5ebe3642d1995ab866db29270b36535',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be',
  'symfony/service-contracts' => 'v2.4.0@f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb',
  'symfony/stopwatch' => 'v5.3.4@b24c6a92c6db316fee69e38c80591e080e41536c',
  'symfony/string' => 'v5.3.7@8d224396e28d30f81969f083a58763b8b9ceb0a5',
  'thecodingmachine/safe' => 'v1.3.3@a8ab0876305a4cdaef31b2350fcb9811b5608dbc',
  'tivie/php-os-detector' => '1.1.0@9461dcd85c00e03842264f2fc8ccdc8d46867321',
  'vlucas/phpdotenv' => 'v5.3.0@b3eac5c7ac896e52deab4a99068e3f4ab12d9e56',
  'wyrihaximus/composer-update-bin-autoload-path' => '1.1.1@33413e3af4f4d7ab4de3653a706aed57f51e84af',
  'wyrihaximus/constants' => '1.6.0@32ceffdd881593c7fa24d8fcbf9deb58687484cb',
  'wyrihaximus/cpu-core-detector' => '2.0.0@287aa2730d8d3a8f581004bb7b95fab1b4e5708f',
  'wyrihaximus/file-descriptors' => '1.1.0@7e2a8330c6dfe535a597e8a317b31dddf3b49398',
  'wyrihaximus/json-throwable' => '4.1.0@d01d59a101d4d2639ec3be770646a7e6b168fafb',
  'wyrihaximus/json-utilities' => '1.3.0@dce46df18c70ab7e206fe7bda4f4c59506f17be6',
  'wyrihaximus/react-child-process-messenger' => '4.0.0@c8af6e67f04efdb97735904bd23119ad0f3f1c14',
  'wyrihaximus/react-child-process-pool' => '1.8.0@708dc34ba2b823b9c8e2935b9f1e807b4d8c11f9',
  'wyrihaximus/react-child-process-promise' => '3.0.0@4eb763563dc382dd03b46f9fab0fd1993af68316',
  'wyrihaximus/ticking-promise' => '2.1.0@d3903d4bebe8e3c5b11464c0bb81802cdeeb3751',
  '__root__' => '1.0.0+no-version-set@',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === []) {
                return false;
            }
        }

        return true;
    }
}
