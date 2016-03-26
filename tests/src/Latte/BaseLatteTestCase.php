<?php

namespace Mesour\Template\Tests\Latte;

use Mesour\Template\Latte\LatteTemplate;
use Mesour\Template\Tests\BaseTestCase;

abstract class BaseLatteTestCase extends BaseTestCase
{

	protected function createEngine()
	{
		return new LatteTemplate();
	}

	protected function getTemplatePath($fileName)
	{
		return __DIR__ . '/templates/' . $fileName . '.latte';
	}

}
