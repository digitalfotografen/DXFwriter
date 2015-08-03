<?php
require_once 'Entity.php';

/**
* Insert Block instance.
* subclass of Entity
* 
* Used attributes
* point (required) default (0, 0, 0)
*
*/

class DxfInsert extends DxfEntity{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['point'] = array(0, 0, 0);
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
		$result = sprintf("0\nINSERT\n2\n%s\n%s\n%s",
									$this->attributes['name'],
									$this->common(),
									point($this->attributes['point'])
				);
		if (isset($this->attributes['xscale'])){
			$result .= sprintf("41\n%s\n", $this->attributes['xscale']);
		}
		if (isset($this->attributes['yscale'])){
			$result .= sprintf("42\n%s\n", $this->attributes['yscale']);
		}
		if (isset($this->attributes['zscale'])){
			$result .= sprintf("43\n%s\n", $this->attributes['zscale']);
		}
		if (isset($this->attributes['rotation'])){
			$result .= sprintf("50\n%s\n", $this->attributes['rotation']);
		}
		if (isset($this->attributes['cols'])){
			$result .= sprintf("70\n%s\n", $this->attributes['cols']);
		}
		if (isset($this->attributes['rotation'])){
			$result .= sprintf("44\n%s\n", $this->attributes['colspacing']);
		}
		if (isset($this->attributes['rows'])){
			$result .= sprintf("71\n%s\n", $this->attributes['rows']);
		}
		if (isset($this->attributes['rowspacing'])){
			$result .= sprintf("45\n%s\n", $this->attributes['rowspacing']);
		}
		return $result;
	}
}
?>
