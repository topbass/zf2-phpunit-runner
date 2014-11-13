<?php
/**
 * ZF2 Phpunit Runner
 *
 * @link      https://github.com/waltzofpearls/zf2-phpunit-runner for the canonical source repository
 * @copyright Copyright (c) 2014 Topbass Labs (topbasslabs.com)
 * @author    Waltz.of.Pearls <rollie@topbasslabs.com, rollie.ma@gmail.com>
 */

return array(
    // Console router
    'console' => array(
        'router' => array(
            'routes' => array(
                'print-usage' => array(
                    'options' => array(
                        'route'    => '[--help|-h]:printUsage',
                        'defaults' => array(
                            'controller' => 'PhpunitRunner\Controller\Main',
                            'action'     => 'usage'
                        ),
                    ),
                ),
                'test-run' => array(
                    'options' => array(
                        'route'    => 'test (all|db|app):typeOf [--module=] [--verbose|-v] [--help|-h]',
                        'defaults' => array(
                            'controller' => 'PhpunitRunner\Controller\Test',
                            'action'     => 'run'
                        ),
                    ),
                ),
            ),
        ),
    ),
    // Controller and controller plugin
    'controllers' => array(
        'invokables' => array(
            'PhpunitRunner\Controller\Main' => 'PhpunitRunner\Controller\MainController',
            'PhpunitRunner\Controller\Test' => 'PhpunitRunner\Controller\TestController',
        ),
    ),
);
