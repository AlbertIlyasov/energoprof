<?

class PageModel extends Model
{
	protected $_exists;
	protected $_pageId;
	protected $_title;
	protected $_header;
	protected $_body;
	protected $_bodyExt;
	protected $_created;
	protected $_changed;


	public function load($pageId)
	{
		$pageId = (int)$pageId;

			$page = DB::getRow('SELECT page_id, title, header, body, body_ext, created, changed FROM pages WHERE page_id=?',array($pageId));
			if ($page) {
				$this->_exists  = $page['page_id'];
				$this->_pageId  = $page['page_id'];
				$this->_title   = $page['title'];
				$this->_header  = $page['header'];
				$this->_body    = $page['body'];
				$this->_bodyExt = $page['bodyExt'];
				$this->_created = $page['created'];
				$this->_changed = $page['changed'];
			}
		return $this;
	}


	public function getPageId()
	{
		return $this->_pageId;
	}


	public function getTitle()
	{
		return $this->_title;
	}


	public function getHeader()
	{
		return $this->_header;
	}


	public function getBody()
	{
		return $this->_body;
	}


	public function getBodyExt()
	{
		return $this->_bodyExt;
	}


	public function getCreated()
	{
		return $this->_created;
	}


	public function getChanged()
	{
		return $this->_changed;
	}


	public function set($data)
	{
		isset($data['title'])   ? $this->_title   = $data['title']   : '';
		isset($data['header'])  ? $this->_header  = $data['header']  : '';
		isset($data['body'])    ? $this->_body    = $data['body']    : '';
		isset($data['bodyExt']) ? $this->_bodyExt = $data['bodyExt'] : '';
		return $this;
	}


	public function save()
	{
		if ($this->getPageId()) {
			$sql = 'UPDATE pages SET title=:title, header=:header, body=:body, body_ext=:bodyExt WHERE page_id=:page_id LIMIT 1';
			$fields = array(
				':page_id' => $this->getPageId(),
				':title'   => $this->getTitle(),
				':header'  => $this->getHeader(),
				':body'    => $this->getBody(),
				':bodyExt' => $this->getBodyExt(),
				);
			$sth = DB::getDbh()->prepare($sql);
			$sth->execute($fields);
		} else {
			$sql = 'INSERT INTO pages (title, header, body, body_ext, created) 
				              VALUES (:title,:header,:body,:bodyExt, NOW())';
			$fields = array(
				':title'   => $this->getTitle(),
				':header'  => $this->getHeader(),
				':body'    => $this->getBody(),
				':bodyExt' => $this->getBodyExt(),
				);
			$sth = DB::getDbh()->prepare($sql);
			$sth->execute($fields);

			$this->_pageId = DB::getDbh()->lastInsertId();
			$this->_exists = $this->_pageId;
		}

		return $this;
	}


	public function isExists()
	{
		return $this->_exists;
	}


	public function delete()
	{
		if ($this->isExists()) {
			DB::getDbh()->exec('DELETE FROM pages WHERE page_id='.(int)$this->getPageId().' LIMIT 1');
			$this->_exists  = null;
			$this->_pageId  = null;
			$this->_title   = null;
			$this->_header  = null;
			$this->_body    = null;
			$this->_bodyExt = null;
			$this->_created = null;
			$this->_changed = null;
		}
		return $this;
	}
}