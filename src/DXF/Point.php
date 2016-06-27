<?php
namespace DXF;

/**
* Point
* subclass of Entity
*
* Used attributes
* point (required) array
*/

class Point extends Entity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* __toString
	* Returns a string representation of entity
	* Calles common of parent to output common attributes
	* @return 	string	the string representation of this entity
	*/
	function __toString(){
		// TODO all are string values, maybee som should be decimal
		return sprintf("0\nPOINT\n%s\n%s",
									$this->common(),
									point($this->attributes['point'])
				);
	}
}#