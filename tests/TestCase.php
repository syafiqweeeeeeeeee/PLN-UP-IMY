<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Environment variables level OS di Windows/Laragon (mis. APP_ENV=local,
     * DB_DATABASE=pln_up_imy) masuk ke $_SERVER dan diprioritaskan phpdotenv
     * di atas $_ENV yang diisi phpunit.xml — sehingga konfigurasi test tidak
     * pernah diterapkan dan test bisa menyusup ke database development.
     *
     * Fix: sinkronkan semua <env> dari phpunit.xml ke $_SERVER (dan $_ENV)
     * sebelum aplikasi boot, agar test selalu memakai konfigurasi test.
     */
    public function createApplication()
    {
        $phpunitXml = simplexml_load_file(dirname(__DIR__) . '/phpunit.xml');

        foreach ($phpunitXml->xpath('//env') as $env) {
            $name  = (string) $env['name'];
            $value = (string) $env['value'];

            $_ENV[$name]    = $value;
            $_SERVER[$name] = $value;
        }

        return parent::createApplication();
    }
}
