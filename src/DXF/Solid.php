<?php
namespace DXF;

/**
* Colored solid fill based on three or four points
* subclass of Entity
*
* Used attributes
* points (required) array of three or four points
*/

class Solid extends Entity{

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
		$result = sprintf("0\nSOLID\n%s\n%s",
									$this->common(),
									points($this->attributes['points'])
				);
		if (count($this->attributes['points']) < 4){
			$result .= point($this->attributes['points'][2]);
		}
		return $result;
	}
}#