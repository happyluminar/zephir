<?php

/*
 * This file is part of the Zephir.
 *
 * (c) Phalcon Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

require_once __DIR__.'/../Library/autoload.php';

if (!extension_loaded('phalcon')) {
    include_once __DIR__.'/../prototypes/phalcon.php';
}

if (!extension_loaded('stub')) {
    if ('1' == ini_get('enable_dl')) {
        $prefix = (PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '';
        dl($prefix.'stub.'.PHP_SHLIB_SUFFIX);
    } else {
        $message = sprintf("The 'stub' extension not loaded; cannot run tests without it");
        $line = str_repeat('-', strlen($message) + 4);

        $message = sprintf("%s\n| %s |\n%s\n\n", $line, $message, $line);
        exit($message);
    }
}
