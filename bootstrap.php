<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Di\Aop\AstVisitorRegistry;
use Hyperf\Di\Aop\PropertyHandlerVisitor;
use Hyperf\Di\Aop\ProxyCallVisitor;
use Hyperf\Di\Aop\RegisterInjectPropertyHandler;

// ini_set('display_errors', 'on');
// ini_set('display_startup_errors', 'on');
//
// error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/vendor/autoload.php';

// Register AST visitors to the collector.
AstVisitorRegistry::insert(PropertyHandlerVisitor::class);
AstVisitorRegistry::insert(ProxyCallVisitor::class);

// Register Property Handler.
RegisterInjectPropertyHandler::register();
