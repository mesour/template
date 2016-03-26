<?php

namespace Mesour\Template\Tests\Latte;

use Mesour\Template\FileNotFoundException;
use Mesour\Template\InvalidStateException;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class ExceptionsTestCase extends BaseLatteTestCase
{

	public function testFile()
	{
		Assert::exception(
			function () {
				$template = $this->createTemplate($this->createEngine());

				$this->getStringFromOb($template);
			},
			InvalidStateException::class,
			'Template file is required.'
		);
	}

	public function testFileNotExists()
	{
		Assert::exception(
			function () {
				$template = $this->createTemplate($this->createEngine());

				$template->setFile('unknown');
			},
			FileNotFoundException::class,
			'Template file unknown not found'
		);
	}

	public function testReservedParameters()
	{
		Assert::exception(
			function () {
				$template = $this->createTemplate($this->createEngine());

				$template->setFile($this->getTemplatePath('default'));

				$template->_block = 'test block';

				$this->getStringFromOb($template);
			},
			InvalidStateException::class,
			'Template variables "_block" and "_template_path" are reserved for LatteEngine.'
		);
		Assert::exception(
			function () {
				$template = $this->createTemplate($this->createEngine());

				$template->setFile($this->getTemplatePath('default'));

				$template->_template_path = 'test';

				$this->getStringFromOb($template);
			},
			InvalidStateException::class,
			'Template variables "_block" and "_template_path" are reserved for LatteEngine.'
		);
	}

}

$test = new ExceptionsTestCase();
$test->run();
