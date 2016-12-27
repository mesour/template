<?php
/**
 * This file is part of the Mesour Template (http://components.mesour.com/version3/component/template/)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Template\Latte;

use Latte\Engine;
use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 */
class LatteTemplate extends Mesour\Template\AbstractTemplate
{

	/**
	 * @var Engine
	 */
	private static $engine;

	private $block;

	public function __construct()
	{
		if (!class_exists('Latte\Engine')) {
			throw new Mesour\Template\InvalidStateException('TemplateFile require composer package "latte/latte".');
		}
		if (!self::$engine) {
			self::$engine = new Engine;
		}
	}

	public function setBlock($block)
	{
		$this->block = $block;
	}

	public function setTempDirectory($tempDir)
	{
		self::$engine->setTempDirectory($tempDir);
	}

	public function setTranslator(Mesour\Components\Localization\ITranslator $translator = null)
	{
		self::$engine->addFilter('translate', function ($message, $count = null) use ($translator) {
			$object = $translator ?: $this->getNullTranslator();
			return call_user_func_array([$object, 'translate'], [$message, $count]);
		});
	}

	public function render($toString = false)
	{
		if (!$toString) {
			self::$engine->render(__DIR__ . '/default.latte', $this->getParameters());
		} else {
			return self::$engine->renderToString(__DIR__ . '/default.latte', $this->getParameters());
		}
		return '';
	}

	public function __toString()
	{
		try {
			return $this->render(true);
		} catch (\Exception $e) {
			trigger_error($e->getMessage(), E_USER_WARNING);
			return '';
		}
	}

	protected function getParameters()
	{
		$parameters = parent::getParameters();
		if (isset($parameters['_block']) || isset($parameters['_template_path'])) {
			throw new Mesour\Template\InvalidStateException(
				'Template variables "_block" and "_template_path" are reserved for LatteEngine.'
			);
		}
		return array_merge(
			$parameters,
			[
				'_block' => $this->block,
				'_template_path' => $this->getFile(),
			]
		);
	}

}
