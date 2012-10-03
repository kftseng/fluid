<?php

define('CLASS_BASE_DIR', __DIR__);

$baseDir = __DIR__;
require_once $baseDir . '/TYPO3/Fluid/Object/ObjectManagerInterface.php';
require_once $baseDir . '/TYPO3/Fluid/Object/ObjectManager.php';
$loader = new \TYPO3\Fluid\Object\ObjectManager('TYPO3', __DIR__);
$loader->setIncludePath(__DIR__);
$loader->register();

$variables = array(
	'foo' => 'not bar',
	'bar' => 'not foo',
);
$view = $loader->create('TYPO3\\Fluid\\View\\StandaloneView');
$view->setLayoutRootPath($baseDir . '/Example/Layouts/');
$view->setPartialRootPath($baseDir . '/Example/Partials/');
$view->setTemplatePathAndFilename($baseDir . '/Example/Templates/Example.html');
$view->assign('assignedVariables', $variables);

echo $view->render();
