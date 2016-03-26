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
interface ITemplate
{

	public function setFile($file);

	public function setBlock($block);

	public function setTempDirectory($tempDir);

	public function setParameters($parameters);

	public function render($toString = false);

	public function __toString();

}
