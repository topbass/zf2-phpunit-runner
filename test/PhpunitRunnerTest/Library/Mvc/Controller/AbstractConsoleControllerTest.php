<?php
/**
 * ZF2 Phpunit Runner - Unit Test Suite
 *
 * @link      https://github.com/waltzofpearls/zf2-phpunit-runner for the canonical source repository
 * @copyright Copyright (c) 2014 Topbass Labs (topbasslabs.com)
 * @author    Waltz.of.Pearls <rollie@topbasslabs.com, rollie.ma@gmail.com>
 */

namespace PhpunitRunnerTest\Library\Mvc\Controller;

use PhpunitRunnerTest\Bootstrap;
use PHPUnit_Framework_TestCase;

class AbstractConsoleControllerTest extends PHPUnit_Framework_TestCase
{
    protected $serviceManager;

    public function setUp()
    {
        parent::setUp();

        $this->serviceManager = Bootstrap::getServiceManager();
    }

    public function testTest()
    {
        //
    }
}
