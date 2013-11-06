<?php
/**
* yEvent - Query Class
* @author Tor Morten Jensen
* @since 0.0.1
*/

class yedb {

	public $prefix = DB_PREFIX;

	public function __construct() {



	}

	public function results($table = false, $select = array(), $relation = 'AND', $limit = 0, $order = array() ) {

		global $db;

		$query = "SELECT * FROM `{$this->prefix}$table`";

		if(!is_array($select) or !$table or empty($select)) {
			$query .= ' WHERE ';
			$elements = array();
			foreach($select as $key => $value) {
				$elements[] = "`{$key}` = '$value'";
			}
			$query .= implode(' '.$relation.' ', $elements);
		}	

		if($order)
			$query .= " ORDER by `{$order['key']}` {$order['method']} ";

		if($limit)
			$query .= " LIMIT {$limit} ";

		$results = $db->query($query);

		if($results) {
			$object = array();

			while($row = $results->fetch_object()) {
				$object[] = $row;
			}
			
			return $object;
		}
		else {
			return $db->error;
		}

	}

	public function single($table = false, $select = array(), $relation = 'AND' ) {

		global $db;

		$query = "SELECT * FROM `{$this->prefix}$table`";

		if(!is_array($select) or !$table or empty($select)) {
			$query .= ' WHERE ';
			$elements = array();
			foreach($select as $key => $value) {
				$elements[] = "`{$key}` = '$value'";
			}
			$query .= implode(' '.$relation.' ', $elements);
		}	

		$query .= " LIMIT 1 ";

		$results = $db->query($query);

		if($results) {
			$object = $results->fetch_object();
			
			return $object;
		}
		else {
			return false;
		}

	}

}

$yedb = new yedb;