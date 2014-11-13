<?php
/**
 * ZF2 Phpunit Runner
 *
 * @link      https://github.com/waltzofpearls/zf2-phpunit-runner for the canonical source repository
 * @copyright Copyright (c) 2014 Topbass Labs (topbasslabs.com)
 * @author    Waltz.of.Pearls <rollie@topbasslabs.com, rollie.ma@gmail.com>
 */

namespace PhpunitRunner\Controller;

use PhpunitRunner\Library\Mvc\Controller\AbstractConsoleController;

class TestController extends AbstractConsoleController
{
    const MODULE  = './module/';
    const PHPUNIT = './vendor/phpunit/phpunit/phpunit.php';

    protected $exceptions = array(
        '.',
        '..',
        '.gitignore',
    );

    public function runAction()
    {
        $request = $this->getRequest();
        $type = $request->getParam('typeOf', 'all');
        $module = $request->getParam('module', 'all');

        $this->verbose = $request->getParam('verbose') || $request->getParam('v');
        $this->help = $request->getParam('help') || $request->getParam('h');

        $modules = array_diff(
            scandir(static::MODULE),
            $this->exceptions
        );

        if (count($modules) == 0) {
            return $this->responseError('*ERROR*: No module found in the application.');
        }

        if ($module != 'all') {
            $modules = array_intersect($modules, explode(',', $module));
        }

        if (count($modules) == 0) {
            return $this->responseError(sprintf(
                '[Console] *ERROR* Option [moudle]\'s value [%s] doesn\'t match any modules in the application.',
                $module
            ));
        }

        $root = getcwd();

        foreach ($modules as $mod) {
            $phpunit = realpath(sprintf('%s/%s', $root, static::PHPUNIT));
            $tests   = realpath(sprintf('%s/%s%s/test', $root, static::MODULE, $mod));

            if (!file_exists($tests)) {
                $this->printMessage(sprintf('[Console] *ERROR* No test suite found in module [%s].', $mod));
                continue;
            }

            $this->printMessage(sprintf('[Console] Start running unit test for module [%s]...', $mod));

            chdir($tests);
            passthru(sprintf('php %s', $phpunit), $error);
            chdir($root);

            if ($error !== 0) {
                $this->printMessage(sprintf('[Console] *FAILURE* Test failed for module [%s].', $mod));
                exit($error);
            }

            flush();
        }
    }

    public function usageAction()
    {
    }
}
