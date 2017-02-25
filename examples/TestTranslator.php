<?php

namespace Mesour\TemplateTests;

use Mesour\Components\Localization\ITranslator;

class TestTranslator implements ITranslator
{

	public function translate($message, $count = null)
	{
		return 123645;
	}

}