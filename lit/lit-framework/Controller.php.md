# Controller from Jeff's TinyMVC

```php
class Controller
{
	public $view;

	function __construct(View $view)
	{
		$this->view = $view;

		// determine what page you're on
		$this->render();
	}

	function render()
	{
		$this->view->make($_SERVER["REQUEST_URI"]);
	}
}
```
