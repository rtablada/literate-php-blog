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
	public function make($uri)
	{
		$contents = $this->getContents($uri);
		echo "<pre>$contents</pre>";
	}

/**
 * Get the contents to pass back based on the uri.
 */
	protected function getContents($uri)
	{
		$path = $this->getPath($uri);
		return $this->file->get($path);
	}

/**
 * Get the file path based on the uri.
 */
	protected function getPath($uri)
	{
		$uri = $uri == '/' ? 'public/index' : $uri;

		if ($this->file->exists(base_path().'/lit/'.$uri.'.php.md')) {
			return base_path().'/lit/'.$uri.'.php.md';
		}
	}
}

