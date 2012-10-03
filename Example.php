<?php

/**
 * Initial constants
 *
 * These are only necessary for this example; however, CLASS_CACHE_DIR
 * is temporarily required (until a ConfigurationManager can be
 * backported in a sensible incarnation).
 */
$baseDir = __DIR__;
	// Constant used by the ClassLoader below. Only necessary for this particular ClassLoader to work.
define('CLASS_BASE_DIR', $baseDir);
	// Cache dir where TYPO3 Fluid will write pre-compiled PHP class files
define('CLASS_CACHE_DIR', __DIR__ . '/Cache/');

/**
 * Class loading
 *
 * The next five lines initialize a ClassLoader that is built into the
 * ObjectManager class. If class loading is not to be enabled (for example
 * when this is already provided by a framework such as Symfony) simply
 * skip these require_once lines and class loader initializations.
 */
require_once $baseDir . '/TYPO3/Fluid/Object/ObjectManagerInterface.php';
require_once $baseDir . '/TYPO3/Fluid/Object/ObjectManager.php';
$loader = new \TYPO3\Fluid\Object\ObjectManager('TYPO3', $baseDir);
$loader->setIncludePath(__DIR__);
$loader->register();

/**
 * Template resource configuration
 *
 * These next variables are what is necessary in order to render a Fluid
 * template that uses all the available constructs; Layouts, Partials and variables.
 * Additional information can be found in the example template itself.
 */
$templatePathAndFilename = $baseDir . '/Example/Templates/Example.html';
$layoutRootPath = $baseDir . '/Example/Layouts/';
$partialRootPath = $baseDir . '/Example/Partials/';
$variables = array(
	'foo' => 'not bar',
	'bar' => 'not foo',
);

/**
 * Initialization
 *
 * All arguments except $templatePathAndFilename are optional.
 * $variables must be an array.
 *
 * If constructor arguments are not desired there is an alternative below.
 *
 * We then allow TYPO3 Fluid to create pre-compiled PHP class versions of our
 * template files by setting the template cache dir.
 */
$view = new \TYPO3\Fluid\FluidTemplate($templatePathAndFilename, $variables, $layoutRootPath, $partialRootPath);

/**
 * Alternative configuration method
 *
 * Below is (redundant but harmless) an alternative method of specifying paths, template,
 * variables etc.
 *
 * The order is not important but in this example we follow the above argument sequence.
 */
$view->setTemplatePathAndFilename($templatePathAndFilename);
$view->assignMultiple($variables);
$view->setLayoutRootPath($layoutRootPath);
$view->setPartialRootPath($partialRootPath);
	// assign one last variable used by the Example template for illustrations
$view->assign('assignedVariables', $variables);

	// no comment necessary
echo $view->render();
exit();
