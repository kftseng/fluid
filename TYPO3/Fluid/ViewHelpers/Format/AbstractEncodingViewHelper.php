<?php
namespace TYPO3\Fluid\ViewHelpers\Format;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */
/**
 * This is the base class for ViewHelpers that work with encodings.
 * Currently that are format.htmlentities, format.htmlentitiesDecode and format.htmlspecialchars
 */
abstract class AbstractEncodingViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var string
	 */
	static protected $defaultEncoding = NULL;

	/**
	 * Resolve the default encoding. If none is set in Frontend or Backend, uses UTF-8.
	 *
	 * @return string the encoding
	 */
	protected function resolveDefaultEncoding() {
		if (self::$defaultEncoding === NULL) {
			if (TYPO3_MODE === 'BE') {
				self::$defaultEncoding = strtoupper($GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset']);
			} else {
				self::$defaultEncoding = strtoupper($GLOBALS['TSFE']->renderCharset);
			}
			if (self::$defaultEncoding === NULL) {
				self::$defaultEncoding = 'UTF-8';
			}
		}
		return self::$defaultEncoding;
	}

}


?>