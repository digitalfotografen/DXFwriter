<?php
require_once 'Entity.php';

/**
* Circle
* subclass of Entity
* 
* Used attributes
* center default array(0,0,0)
* radius default 1
*/

class DxfCircle extends DxfEntity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['center'] = array(0, 0, 0);
		$defaults['radius'] = 1;
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
		return sprintf("0\nCIRCLE\n%s\n%s40\n%f\n",
									$this->common(),
									point($this->attributes['center']),
									$this->attributes['radius']
				);
	}
}

