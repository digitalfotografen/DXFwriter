<?php
require_once 'Collection.php';

/**
* Block of Entities
* 
* Stores a collection of entities (geometric forms) so that they can be reused
* as a component
*
* Add entities by calling the append method of the parent class
*
* Used attributes
* name default 'block'
* flag default 0
* layer default 0
* base default array(0,0,0)
* obliqueAngle default 50
* mirror default 0
* font default 'arial.ttf'
* bigFont default ''
*/

class DxfBlock extends DxfCollection{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  	Array	$attributes	array of attributes
	* @param  	Array	$entities array of entities
	*/
	function __construct($attributes = array(), $entities = array()){		
		$defaults = array();
		$defaults['name'] = 'block';
		$defaults['flag'] = 0;
		$defaults['layer'] = 0;
		$defaults['base'] = array(0,0,0);
		$defaults['obliqueAngle'] = 50;
		$defaults['mirror'] = 0;
		$defaults['lastHeight'] = 1;
		$defaults['font'] = 'arial.ttf';
		$defaults['bigFont'] = '';
		parent::__construct(array_merge($defaults, $attributes), $entities);
	}

	/*
	* __toString
	* Returns a string representation of all merged entities
	* Calls __toString on each stored Entity
	*
	* @return 	string	the string representation of all entities
	*/
	function __toString(){
		return sprintf("0\nBLOCK\n8\n%s\n2\n%s\n70\n%s\n%s3\n%s\n%s\n0\nENDBLK\n",
						$this->attributes['layer'],
						strtoupper($this->attributes['name']),
						$this->attributes['flag'],
						point($this->attributes['base']),
						strtoupper($this->attributes['name']),
						parent::__toString()
				);
	}
}
