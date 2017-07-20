<?

class Helper
{
	static public function isLocal()
	{
		if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
			return true;
		} else {
			return false;
		}
	}


	static public function spaces($qty, $space='&nbsp;')
	{
		$qty = (int)$qty;

		$s = $space;
		switch ($qty) {
			case 0:
				return;
				break;
			case 1:
				return $s;
				break;
			case 2:
				return $s.$s;
				break;
			case 3:
				return $s.$s.$s;
				break;
			case 4:
				return $s.$s.$s.$s;
				break;
			case 5:
				return $s.$s.$s.$s.$s;
				break;
			case 6:
				return $s.$s.$s.$s.$s.$s;
				break;
			case 7:
				return $s.$s.$s.$s.$s.$s.$s;
				break;
			default:
				$spaces = '';
				for ($i=0; $i<$qty; $i++) {
					$spaces .= $s;
				}
				return $spaces;
				break;
		}
	}


	static public function renderTable($heads, $rows)
	{
		if (empty($rows) || !is_array($rows)) {
			return;
		}

		if (empty($heads) || !is_array($heads)) {
			foreach ($rows[0] as $field=>$val) {
				$heads[$field] = $field;
			}
		}

		$out .= '<table border=0 cellpadding=0 cellspacing=0 class="table table-striped">';

		$out .= '<tr>';
		if ($heads[0] == 'i') {
	    	$out .= '<th>№</th>';
	    	unset($heads[0]);
	    	$i = 1;
		}
		foreach ($heads as $head) {
	    	$out .= '<th>'.$head.'</th>';
		}
		$out .= '</tr>';

		foreach ($rows as $row) {
			$out .= '<tr>';
			if ($i) {
				$out .= '<td>'.$i++.'</td>';
			}
			foreach ($row as $td) {
		    	$out .= '<td>'.$td.'</td>';
			}
			$out .= '</tr>';
		}

		$out .= '</table>';

		return $out;
	}


	static public function renderAngularTable($heads, $rows, $orderBy = array(), $filter = '', array $rowPrepared = array(), array $headPrepared = array())
	{
		$ths = '';
		$tds = '';

		if (empty($rows) || !is_array($rows)) {
			return;
		}

		if (empty($heads) && isset($rows[0])) {
			foreach ($rows[0] as $field=>$val) {
				$heads[$field] = $field;
			}
		}

		if (isset($heads['i'])) {
	    	$ths .= '<th ng-click="propertyName = null; reverse=false;" class="pointer">'.$heads['i'].'</th>';
	    	$tds .= '<td>{{index+1}}</td>';
	    	unset($heads['i']);
		}
		//i - это опция номера строки, она не участвует в сортировке.
		if (isset($orderBy['i'])) {
	    	unset($orderBy['i']);
	    }

		foreach ($heads as $field=>$title) {

			if (isset($headPrepared[$field])) {
	    		$thVal = $headPrepared[$field];
	    	} else {
	    		$thVal = $title;
	    	}
	    	$ths .= '<th ng-click="orderBy(\''.$field.'\')" class="pointer">'.$thVal
	    		//.'<span class="sortorder" ng-show="propertyName === \''.$field.'\'" ng-class="{reverse: reverse}"></span>'
	    		.'</th>';

	    	if (isset($rowPrepared[$field])) {
	    		$tds .= '<td>'.$rowPrepared[$field].'</td>';
	    	} elseif ($field == 'dt') {
	    		$tds .= '<td>{{row.'.$field.' | date:"dd.MM.yyyy"}}</td>';
	    	} else {
	    		$tds .= '<td>{{row.'.$field.'}}</td>';
	    	}
		}

		// | filter:query | orderBy:field
		$options = array('(index,row) in data');

		// $selectOrderBy = '';
		// if (!empty($orderBy)) {
		// 	foreach ($orderBy as $field=>$title) {
		// 		$selectVals .= '<option value="'.$field.'">'.$title;
		// 	}	
		// 	$selectOrderBy = 'Сортировка: <select ng-model="dataOrderBy">'.$selectVals.'</select>';
		// 	$options['orderBy'] = 'orderBy:dataOrderBy:true';
		// }
		$options['orderBy'] = 'orderBy:propertyName:reverse';

		$inputFilter = '';
		if (!empty($filter)) {
			$inputFilter = 'Фильтр: <input type=text ng-model="dataFilter">';
			$options[] = 'filter:dataFilter';
		}

		if (isset($rows[0]['DOP_INFO'])) {
			foreach ($rows as $i=>$row) {
				$rows[$i]['DOP_INFO'] = '';//str_replace("\r\n", '', htmlspecialchars($rows[$i]['DOP_INFO']));
			}
		}

		//$options[]='limitTo:3';

		//str_replace(array('<', '>'), array('&lt;', '&gt;'), json_encode($rows, JSON_NUMERIC_CHECK))
		return '<div ng-controller="table">'.$inputFilter//.' '.$selectOrderBy
			.'<table border=0 cellpadding=0 cellspacing=0 class="table table-striped" ng-init=\'data='
			.(defined('JSON_UNESCAPED_UNICODE') 
				? json_encode($rows, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE) 
				: json_encode($rows, JSON_NUMERIC_CHECK))
			.'\'>
				<tr>'.$ths.'</tr>
				<tr ng-repeat="'.implode(' | ', $options).'">'.$tds."\r\n".'</tr>
			</table></div>';
	}


	static public function go($path)
	{
		die(Header('Location: '.URL.$path));
	}


	static public function get($a)
	{
		if (!empty($_GET)) {
			if (array_key_exists($a, $_GET)) {
				return $_GET[$a];
			}
		}
		return null;
	}


	static public function post($a)
	{
		if (!empty($_POST)) {
			if (array_key_exists($a, $_POST)) {
				return $_POST[$a];
			}
		}
		return null;
	}


	static public function html_select($name, array $options_array, $option_selected = '', $format = '')
	{
		$to_out = '';
		if ($format)
			$format = ' '.$format;
		$to_out .= '<select name='.$name.$format.'>';
		foreach ($options_array as $key => $value)
		{
			if ($key == $option_selected)
				$selected = ' selected';
			else
				$selected = '';
			$to_out .= '<option value="'.$key.'"'.$selected.'>'.$value;
		}
		$to_out .= '</select>';

		return $to_out;
	}


	static public function dm($a)
	{
		echo '<p>';
		if (is_array($a)) {
			echo '<pre>';
			print_r($a);
			echo '</pre>';
		} else {
			echo $a;
		}
		echo '</p>';
	}


	static public function html_list($a)
	{
		if (!empty($a)) {
			if (is_array($a)) {
				if (count($a)) {
					return '<ul><li>'.implode('<li>', $a).'</ul>';
				}
			}
		}
	}
}