<?php

/*
 +--------------------------------------------------------------------------+
 | Zephir Language                                                          |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2013-2017 Zephir Team and contributors                     |
 +--------------------------------------------------------------------------+
 | This source file is subject the MIT license, that is bundled with        |
 | this package in the file LICENSE, and is available through the           |
 | world-wide-web at the following url:                                     |
 | http://zephir-lang.com/license.html                                      |
 |                                                                          |
 | If you did not receive a copy of the MIT license and are unable          |
 | to obtain it through the world-wide-web, please send a note to           |
 | license@zephir-lang.com so we can mail you a copy immediately.           |
 +--------------------------------------------------------------------------+
*/

namespace Extension\Oo;

use PDO;
use Test\Oo\ConcreteStatic;
use Test\Oo\ExtendPdoClass;

class ExtendClassTest extends \PHPUnit_Framework_TestCase
{
    public function testPDOExtending()
    {
        if (!extension_loaded('pdo')) {
            $this->markTestSkipped('The PDO extendsion is not loaded');
        }
        $this->assertSame(PDO::getAvailableDrivers(), ExtendPdoClass::getAvailableDrivers());
        $this->assertSame(PDO::PARAM_STR, ExtendPdoClass::PARAM_STR);
    }

    public function testPDOStatementExtending()
    {
        $pdo = new ExtendPdoClass('sqlite::memory:', '', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $stmt = $pdo->prepare('SELECT CURRENT_TIME');

        $this->assertInstanceof('Test\\PdoStatement', $stmt);
    }

    // FIXME
    public function testInstanceOfPhalconMvcApplication()
    {
        /*if (!extension_loaded('phalcon')) {
            $this->markTestSkipped('No phalcon ext loaded');
        }
        $class = new \Test\Oo\Extend\Application();
        $this->assertInstanceOf('Phalcon\Mvc\Application', $class);*/
    }

    // FIXME
    public function testInstanceOfMemcache()
    {
        /*if (!extension_loaded('memcache')) {
            $this->markTestSkipped('No memcache ext loaded');
        }
        $class = new \Test\Oo\Extend\Memcache();
        $this->assertInstanceOf('Memcache', $class);*/
    }

    /**
     * @test
     * @issue 1392
     */
    public function shouldCorrectWorkWithLateStaticBinding()
    {
        $this->assertSame('Test\Oo\ConcreteStatic', ConcreteStatic::getCalledClass());
    }
}
