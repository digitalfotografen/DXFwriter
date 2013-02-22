<?php
require_once 'Entity.php';

/**
* Arc, angles in degrees.
* subclass of Entity
* 
* Used attributes
* center default array(0,0,0)
* radius default 1
* startAngle default 0.1
* endAngle default 90
*/
class DxfArc extends DxfEntity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  	Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['center'] = array(0, 0, 0);
		$defaults['radius'] = 1;
		$defaults['startAngle'] = 0.1;
		$defaults['endAngle'] = 90;
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
		return sprintf("0\nARC\n%s\n%s40\n%f\n50\n%f\n51\n%f",
									$this->common(),
									point($this->attributes['center']),
									$this->attributes['radius'],
									$this->attributes['startAngle'],
									$this->attributes['endAngle']
				);
	}
}
?>