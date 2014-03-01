<?php

// View Class to grab an file and throw it in our layout
use Illuminate\Filesystem\Filesystem;

class View
{

/**
 * We need our filesystem to grab file contents.
 * Also, let's allow people to change the directory we are looking at.
 */
	protected $file;
	protected $directory;

	public function __construct(Filesystem $file, $directory = null)
	{
		$this->file = $file;
		$this->directory = $directory;
	}

/**
 * We need to polulate our layout based on the uri of the request.
 * We also have to build a file tree and pass it to the view for navigation.
 */
	public function make()
	{
		$contents = $this->getContents();
		$litPaths = $this->getLitPaths();

		include base_path('/app/views/layout.php');
	}

/**
 * Get the contents to pass back based on the uri.
 */
	protected function getContents()
	{
		$path = $this->getPath();
		return $this->file->get($path);
	}

/**
 * Get the file path based on the uri.
 */
	protected function getPath()
	{
		$uri = $this->getUri();

		if ($this->file->exists(base_path().'/lit/'.$uri.'.php.md')) {
			return base_path().'/lit/'.$uri.'.php.md';
		}
	}

/**
 * Get the uri
 */
	protected function getUri()
	{
		$uri = $_SERVER["REQUEST_URI"];
		return $uri == '/' ? '/public/index' : $uri;

	}

/**
 * We need to get all the paths from the lit folder.
 * Then we need to make it human readable and not show our Filesystem.
 */
	protected function getLitPaths()
	{
		$files = $this->file->allFiles(base_path('/lit'));

		return array_map(function($file) {
			$path =
				'/' .
				str_replace(base_path('/lit/'), '', $file->getPath()) .
				'/' .
				$file->getBasename('.php.md');

			$active = $path == $this->getUri() ? true : false;

			return compact('path', 'active');
		}, $files);
	}
}

