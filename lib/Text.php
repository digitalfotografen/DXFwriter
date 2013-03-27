<?php
require_once 'Entity.php';

/**
* Single text line.
* subclass of Entity
* 
* Used attributes
* text default ''
* point default array(0,0,0)
* height default 1
*/

class DxfText extends DxfEntity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['text'] = '';
		$defaults['point'] = array(0,0,0);
		$defaults['height'] = 1;
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* __toString
	* Returns a string representation of entity
	* Calls common of parent to output common attributes
	* @return 	string	the string representation of this entity
	*/
	function __toString(){
		// TODO all are string values, maybee som should be decimal
		$result = sprintf("0\nTEXT\n%s\n%s40\n%f\n1\n%s\n",
									$this->common(),
									point($this->attributes['point']),
									$this->attributes['height'],
									$this->attributes['text']
				);
		if (isset($this->attributes['rotation'])){
			$result .= sprintf("50\n%s\n", $this->attributes['rotation']);
		}		
		if (isset($this->attributes['rotation'])){
			$result .= sprintf("50\n%s\n", $this->attributes['rotation']);
		}		
		if (isset($this->attributes['xscale'])){
			$result .= sprintf("41\n%s\n", $this->attributes['xscale']);
		}		
		if (isset($this->attributes['obliqueAngle'])){
			$result .= sprintf("51\n%s\n", $this->attributes['obliqueAngle']);
		}		
		if (isset($this->attributes['style'])){
			$result .= sprintf("7\n%s\n", $this->attributes['style']);
		}		
		if (isset($this->attributes['flag'])){
			$result .= sprintf("71\n%s\n", $this->attributes['flag']);
		}		
		if (isset($this->attributes['justifyhor'])){
			$result .= sprintf("72\n%s\n", $this->attributes['justifyhor']);
		}		
		if (isset($this->attributes['alignment'])){
			$result .= sprintf("%s", point($this->attributes['alignment'], 1));
		}		
		if (isset($this->attributes['justifyver'])){
			$result .= sprintf("73\n%s\n", $this->attributes['justifyver']);
		}
		return $result;
	}
}
?>