<?php

namespace Example\ViewHelpers;

class ExampleViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

	/**
	 * Tag name - when rendered, this is the tag that will be output
	 *
	 * @var string
	 */
	protected $tagName = 'div';

	/**
	 * Initializes arguments that are used by this ViewHelper
	 *
	 * Arguments are specified as tag attributes in the template.
	 */
	public function initializeArguments() {
			// register universal tag attributes such as class, id, style etc.
		$this->registerUniversalTagAttributes();
			// register additional arguments used to render this special tag
		$this->registerArgument('number', 'integer', 'Pick a number - any number', TRUE);
	}

	/**
	 * @return string
	 */
	public function render() {
		$this->tag->setContent('You picked the number ' . $this->arguments['number']);
		return $this->tag->render();
	}

}