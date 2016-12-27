<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<?php

define('SRC_DIR', __DIR__ . '/../src/');

@mkdir(__DIR__ . '/log');
@mkdir(__DIR__ . '/tmp');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestTranslator.php';

\Tracy\Debugger::enable(\Tracy\Debugger::DEVELOPMENT, __DIR__ . '/log');
\Tracy\Debugger::$strictMode = true;

require_once SRC_DIR . 'Mesour/Template/exceptions.php';
require_once SRC_DIR . 'Mesour/Template/ITemplate.php';
require_once SRC_DIR . 'Mesour/Template/AbstractTemplate.php';
require_once SRC_DIR . 'Mesour/Template/Latte/LatteTemplate.php';
require_once SRC_DIR . 'Mesour/UI/TemplateFile.php';

$engine = new \Mesour\Template\Latte\LatteTemplate();

$translator = new \Mesour\TemplateTests\TestTranslator();

$template = new \Mesour\UI\TemplateFile($engine, __DIR__ . '/tmp', $translator);

$template->setFile(__DIR__ . '/template.latte');

$template->setBlock('first');

$template->foo = 'test';

?>

<hr>

<div class="container">
	<h1>Mesour template</h1>

	<div class="jumbotron">
		<?php echo $template; ?>
	</div>
</div>