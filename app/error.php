<?

class Error
{
	public function __construct($e)
	{
		die((string)$e);
		switch ($e) {
			case 404:
				die(Header('HTTP/1.0 404 Not Found'));
			break;
		}
	}
}