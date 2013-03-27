<?php
require_once 'Entity.php';

/**
* LwPolyLine
* This is a LWPOLYLINE. I have no idea how it differs from a normal PolyLine
* I am not sure if the class works, but i doesn't break things...
* TODO: Check how this should work
*
* subclass of Entity
* 
* Used attributes
* points (required) default none
* flag default 0
*/

class DxfLwPolyLine extends DxfEntity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['flag'] = 0;
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
		$result = sprintf("0\nLWPOLYLINE\n%s\n70\n%s\n",
									$this->common(),
									$this->attributes['flag']
		);
		if (isset($this->attributes['width'])){
			$result .= sprintf("43\n%s\n", 
								$this->attributes['width']);
		}		
		$result .= sprintf("90\n%s\n%s",
								count($this->attributes['points']),
								points($this->attributes['points'], false)
		);
		return $result;
	}
}

?>