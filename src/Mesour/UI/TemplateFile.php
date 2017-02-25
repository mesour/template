<?php
/**
 * This file is part of the Mesour Template (http://components.mesour.com/version3/component/template/)
 *
 * Copyright (c) 2017 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\UI;

use Mesour\Components\Localization\ITranslator;
use Mesour\Template;

/**
 * @author Matouš Němec (http://mesour.com)
 */
class TemplateFile extends \stdClass
{

	/** @var Template\ITemplate */
	private $template;

	private $parameters = [];

	public function __construct(Template\ITemplate $engine, $tempDir, ITranslator $translator = null)
	{
		$this->template = $engine;
		$engine->setTempDirectory($tempDir);
		$engine->setTranslator($translator);
	}

	public function setFile($file)
	{
		$this->template->setFile($file);
		return $this;
	}

	public function setBlock($block)
	{
		$this->template->setBlock($block);
		return $this;
	}

	/**
	 * @return Template\ITemplate
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	public function render($toString = false)
	{
		$this->template->setParameters($this->parameters);
		return $this->template->render($toString);
	}

	public function __toString()
	{
		$this->template->setParameters($this->parameters);
		return $this->template->__toString();
	}

	public function __set($name, $value)
	{
		$this->parameters[$name] = $value;
	}

	public function __get($name)
	{
		if (!isset($this->parameters[$name])) {
			throw new Template\OutOfRangeException('Parameter with name ' . $name . ' does not exist.');
		}
		return $this->parameters[$name];
	}

	public function __isset($name)
	{
		return isset($this->parameters[$name]);
	}

	public function __unset($name)
	{
		unset($this->parameters[$name]);
	}

}
