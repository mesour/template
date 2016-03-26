<?php

namespace Mesour\Template\Tests;

use Mesour\Template\ITemplate;
use Mesour\UI\TemplateFile;
use Tester\TestCase;

abstract class BaseTestCase extends TestCase
{

	protected function getStringFromOb(TemplateFile $template)
	{
		ob_start();
		$template->render();
		$out = ob_get_contents();
		ob_end_clean();
		return trim($out);
	}

	protected function createTemplate(ITemplate $template)
	{
		return new \Mesour\UI\TemplateFile($template, TEMP_DIR);
	}

}
