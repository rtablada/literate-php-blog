<?php

// Create a base path
function base_path($path = '')
{
	return __DIR__.'/../..'.$path;
}

// First let's get composer running.
require_once(base_path('/vendor/autoload.php'));

// Let's compile our code
// We will want to create a compiler, then compile with our lit directory.
$parser = new Rtablada\LiteratePhp\Parser;

// Then we want to get our filesystem
$file = new Illuminate\Filesystem\Filesystem;

// Then let's get our files to compile
$literateFiles = $file->allFiles(__DIR__.'/../../lit/');

// Let's compile each file with .php.md
foreach ($literateFiles as $literateFile) {
	if (strpos($literateFile, '.php.md')) {
		$literatePath = $literateFile->__toString();
		$compiledPath = preg_replace('/(.*)lit\/(.*).php.md/', '$1$2.php', $literatePath);

		$literateSrc = $file->get($literatePath);
		$compiledSrc = $parser->parse($literateSrc);

		$file->put($compiledPath, $compiledSrc);
	}
}

// Create a View loader
$view = new View($file);

// Build Controller
new Controller($view);

