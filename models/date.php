<?

class DateModel extends Model
{
	protected $_from;
	protected $_to;


	protected function _setDate($property, $val)
	{
		$date = $val;

		if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
			$ar = explode('-', $date);
	    	if (checkdate($ar[1], $ar[2], $ar[0])) {
	    		$this->$property = $date;
	    	}
    	}

		return $this;
	}


	public function setFrom()
	{
		$this->_setDate('_from', Helper::get('dateFrom'))->changeFromTo();
		return $this;
	}


	public function getFrom()
	{
		return $this->_from;
	}


	public function setTo()
	{
		$this->_setDate('_to', Helper::get('dateTo'))->changeFromTo();
		return $this;
	}


	public function getTo()
	{
		return $this->_to;
	}


	public function changeFromTo()
	{
		$from = $this->getFrom();
		$to   = $this->getTo();

		if ($from && $to) {
			if (strtotime($to) < strtotime($from)) {
				$this->_to   = $from;
				$this->_from = $to;
			}
		}
		return $this;
	}


	public function getSqlWhere($dateField)
	{
		$from = $this->getFrom();
		$to   = $this->getTo();

		$where = '';
		if ($from && $to) {
			$where = $dateField.' between "'.$from.'" and "'.$to.'"';
		} elseif ($from) {
			$where = $dateField.'>="'.$from.'"';
		} elseif ($to) {
			$where = $dateField.'<="'.$to.'"';
		}
		
		return $where;
	}
}