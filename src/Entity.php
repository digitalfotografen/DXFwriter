<?php
require_once 'BaseClass.php';

/**
* Entity
* 
* This is the base class to all geomtric forms (Arc, Circle, Text...)
* Data is stored in the attributes array of the BaseClass
* 
*/

class DxfEntity extends DxfBaseClass{

	var $parent = null;

	/*
	* Constructor
	*
	* Layer is default 0
	*
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes. 
	*
	* @param  	Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array(
				'layer' => 0
		);
		
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* common
	* Return common group codes as a string
	*
	* @return 	string	the string representation of defined common attributes
	*/
	function common(){
		//$parent = isset($parent) ? $this->parent : $this;
		$result = sprintf("8\n%s", $this->attributes['layer']);
		if (isset($this->attributes['color'])){
			$result .= sprintf("\n62\n%s", $this->attributes['color']);
		}
/*
		if (isset($this->attributes['rgbColor'])){
			$result .= sprintf("\n420\n%s", $this->attributes['rgbColor']);
		}
*/		
		if (isset($this->attributes['extrusion'])){
			$result .= sprintf("\n%s", point($this->attributes['extrusion'], 200));
		}
		if (isset($this->attributes['lineType'])){
			$result .= sprintf("\n6\n%s", $this->attributes['lineType']);
		}
		if (isset($this->attributes['lineWeight'])){
			$result .= sprintf("\n370\n%s", $this->attributes['lineWeight']);
		}
		if (isset($this->attributes['lineTypeScale'])){
			$result .= sprintf("\n48\n%s", $this->attributes['lineTypeScale']);
		}
		if (isset($this->attributes['thickness'])){
			$result .= sprintf("\n39\n%s", $this->attributes['thickness']);
		}
		return $result;
	}
}

?>