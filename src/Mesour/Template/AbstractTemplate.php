<?php
/**
 * This file is part of the Mesour Template (http://components.mesour.com/version3/component/template/)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Template;

use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 */
abstract class AbstractTemplate implements ITemplate
{

	private $file;

	private $parameters = [];

	public function setFile($file)
	{
		if (!is_file($file)) {
			throw new FileNotFoundException(sprintf('Template file %s not found', $file));
		}
		$this->file = $file;
	}

	public function setParameters($parameters)
	{
		$this->parameters = array_merge($this->parameters, $parameters);
	}

	protected function getParameters()
	{
		return $this->parameters;
	}

	protected function getFile()
	{
		if (!$this->file) {
			throw new InvalidStateException('Template file is required.');
		}
		return $this->file;
	}

}
