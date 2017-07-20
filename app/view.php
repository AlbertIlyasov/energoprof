<?

class View
{
	protected $_viewFilename=array();
	protected $_vals=array(
		'title'        => '',
		'contentTitle' => '',
		'model'        => '',
		'out'          => '',
		'action'       => '',
		);
	protected $_templateFilename='templates/default/default.php';
	static protected $_debug=array();


	public function set(array $vals)
	{
		$this->_vals = $vals+$this->_vals;
		return $this;
	}


	public function gets()
	{
		return $this->_vals;
	}


	public function render()
	{
		extract($this->gets());

		ob_start();
		if (SITEMODE == DEBUG) {
			echo '<hr><textarea class=debug>';

			if ($this->getDebug()) {
				echo "\$_debug: \r\n";
				print_r(self::getDebug());
			}

			echo "\$_GET: \r\n";
			print_r($_GET);

			echo "\$_POST: \r\n";
			print_r($_POST);

			echo "\$_SERVER: \r\n";
			echo ''; print_r($_SERVER); echo '';

			echo '</textarea><hr>';
		}
		include($this->getViewFilename());
		$out = ob_get_clean();
		ob_end_clean();

		include($this->getTemplateFilename());
		return $this;
	}


	public function renderXml($xml)
	{
		if (!preg_match('/^<\?xml/', $xml)) {
			$xml = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n".$xml;
		}
		Header('Content-Type: text/xml');
		echo $xml;
		return $this;
	}


	public function setViewFilename($filename)
	{
		$this->_viewFilename = INDEX_DIR.'/views/'.$filename.'.php';
		return $this;
	}


	public function getViewFilename()
	{
		return $this->_viewFilename;
	}


	public function setTemplateFilename($filename)
	{
		$this->_templateFilename = $filename;
		return $this;
	}


	public function getTemplateFilename()
	{
		return $this->_templateFilename;
	}


	public function getTitle()
	{
		return $this->_vals['title'];
	}


	public function getContentTitle()
	{
		return $this->_vals['contentTitle'];
	}


	public function renderTitle()
	{
		return ($this->getTitle() ? $this->getTitle().' &mdash; '.SITE_NAME : SITE_NAME);
	}


	public function renderContentTitle()
	{
		return ($this->getContentTitle() ? $this->getContentTitle() : $this->getTitle());
	}


	static public function setDebug($key, $val)
	{
		self::$_debug[$key] = $val;
	}


	static public function getDebug()
	{
		return self::$_debug;
	}
}
