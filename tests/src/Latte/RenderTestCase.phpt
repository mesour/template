<?php

namespace Mesour\Template\Tests\Latte;

use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class RenderTestCase extends BaseLatteTestCase
{

	private $defaultOutput = 'test text';

	private $parametersOutput = 'foo<br>second variable';

	private $firstBlockOutput = 'foo';

	private $secondBlockOutput = '67890';

	private $noBlockSelectedOutput = '';

	public function testDefault()
	{
		$template = $this->createTemplate($this->createEngine());

		$template->setFile($this->getTemplatePath('default'));

		$html = $this->getStringFromOb($template);
		Assert::same($this->defaultOutput, $html);
	}

	public function testParameters()
	{
		$template = $this->createTemplate($this->createEngine());

		$template->setFile($this->getTemplatePath('parameters'));

		$template->foo = 'foo';
		$template->secondVar = 'second variable';

		$html = $this->getStringFromOb($template);
		Assert::same($this->parametersOutput, $html);
	}

	public function testFirstBlock()
	{
		$template = $this->createTemplate($this->createEngine());

		$template->setFile($this->getTemplatePath('blocks'));

		$template->setBlock('first');

		$template->foo = 'foo';

		$html = $this->getStringFromOb($template);
		Assert::same($this->firstBlockOutput, $html);
	}

	public function testSecondBlock()
	{
		$template = $this->createTemplate($this->createEngine());

		$template->setFile($this->getTemplatePath('blocks'));

		$template->setBlock('second');

		$html = $this->getStringFromOb($template);
		Assert::same($this->secondBlockOutput, $html);
	}

	public function testNoBlockSelected()
	{
		$template = $this->createTemplate($this->createEngine());

		$template->setFile($this->getTemplatePath('blocks'));

		$html = $this->getStringFromOb($template);
		Assert::same($this->noBlockSelectedOutput, $html);
	}

}

$test = new RenderTestCase();
$test->run();
