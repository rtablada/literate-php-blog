# Create a base path

```php
function base_path($path = '')
{
	return __DIR__.'/../..'.$path;
}
```

# First let's get composer running.

```php
require_once(base_path('/vendor/autoload.php'));
```

# Let's compile our code
# We will want to create a compiler, then compile with our lit directory.

```php
$parser = new Rtablada\LiteratePhp\Parser;
```

# Then we want to get our filesystem

```php
$file = new Illuminate\Filesystem\Filesystem;
```

# Then let's get our files to compile

```php
$literateFiles = $file->allFiles(__DIR__.'/../../lit/');
```

# Let's compile each file with .php.md
* [x] Check if it is a .php.md file
* [x] Get our compile path
* [x] Get our literate source path
* [x] Parse our literate file
* [x] Put our compiled file in our project

```php
foreach ($literateFiles as $literateFile) {
	if (strpos($literateFile, '.php.md')) {
		$literatePath = $literateFile->__toString();
		$compiledPath = preg_replace('/(.*)lit\/(.*).php.md/', '$1$2.php', $literatePath);

		$literateSrc = $file->get($literatePath);
		$compiledSrc = $parser->parse($literateSrc);

		$file->put($compiledPath, $compiledSrc);
	}
}
```

# Create a View loader

```php
$view = new View($file);
```

# Build Controller

```php
new Controller($view);
```
