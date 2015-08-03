<?php
/**
* Base class
* 
* This is the base class to all classes in DXFwriter
* Data is stored in the attributes array
*/
class DxfBaseClass{
	var $attributes;

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  	Array	$attributes	array of attributes
	* @return 	string	the string representation of all values
	*/
	function __construct($attributes = array()){
		$this->attributes = $attributes;
	}

	/*
	* Returns a cloned copy including attributes array
	*
	* @return 	{BaseClass}	a cloned instance
	*/
	function copy(){
		$copy = clone $this;
		$copy->attributes = $this->attributes;
		return $copy;
	}

	/*
	* Merge and convert array of values to one string
	* Call __toString method on each value 
	* Calls point for each point
	*
	* @param  	Array	$values	array of values
	* @return 	string	the string representation of all values
	*/
	function stringArray($values){
		$strings = array();
		foreach ($values as $value){
			$strings[] = sprintf("%s", $value);
		}
		return $strings;
	}
}

/*
* Convert point array to a dxf point
* Utility function used to output coordinates
*
* @param  	Array	$x	array of points
* @return 	integer	$index index, default 0
*/
function point($x, $index = 0){
	$strings = array();
	
	//echo print_r($x);
	for ($i = 0; $i < count($x); $i++){
		$strings[] = sprintf("%s\n%1.3F\n", 10*($i+1)+$index, $x[$i]);
	}
	return implode($strings);
}

/*
* Convert a list of tuples to dxf points
* Utility function used to merge point lists
* Calls point for each point
*
* @param  	Array	$p	array of arrays with points
* @return 	string	a string with all points
*/
function points($p, $useIndex = true){
	$strings = array();
	
	for ($i=0; $i < count($p); $i++){
		if ($useIndex){
			$strings[] = point($p[$i], $i);
		} else {
			$strings[] = point($p[$i], 0);
		}
	}
	return implode($strings);
}

/*
*
*
*/

function tdDate($date){
	$t = date('U', $date);
	return $t / 86400 + 2440587.5; // convert days since epoch to julian date
}

function cDate($date){
	return date("Ymd.His", $date);
}


?>