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
		$parent = isset($parent) ? $this->parent : $this;
		$result = sprintf("8\n%s", $parent->attributes['layer']);
		if (isset($parent->attributes['color'])){
			$result .= sprintf("\n62\n%s", $parent->attributes['color']);
		}
		if (isset($parent->attributes['extrusion'])){
			$result .= sprintf("\n%s", point($parent->attributes['extrusion'], 200));
		}
		if (isset($parent->attributes['lineType'])){
			$result .= sprintf("\n6\n%s", $parent->attributes['lineType']);
		}
		if (isset($parent->attributes['lineWeight'])){
			$result .= sprintf("\n370\n%s", $parent->attributes['lineWeight']);
		}
		if (isset($parent->attributes['lineTypeScale'])){
			$result .= sprintf("\n48\n%s", $parent->attributes['lineTypeScale']);
		}
		if (isset($parent->attributes['thickness'])){
			$result .= sprintf("\n39\n%s", $parent->attributes['thickness']);
		}
		return $result;
	}
}

?>