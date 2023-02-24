<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/TestEnv.php';

if (file_exists(__DIR__ . '/env.php')) {
    require __DIR__ . '/env.php';
}