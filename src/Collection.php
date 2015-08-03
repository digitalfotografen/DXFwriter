<?php
require_once 'BaseClass.php';
require_once 'Entity.php';

/**
* Collection of Entities
* 
* Stores collections of geometric figures 
*
* Entities are stored inte the entities array
* This is the base class of DXFwriter and Block
* 
*/

class DxfCollection extends DxfBaseClass{
	var $entities = null;
	
	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  	Array	$attributes	array of attributes
	* @param  	Array	$entities array of entities
	*/
	function __construct($attributes = array(), $entities = array()){
		$this->entities= array();
		foreach ($entities as $entity){
			$this->append($entity->copy());
		}
		
		parent::__construct($attributes);
	}

	/*
	* Append entity
	*
	* @param  	{Entity}	$entity	Entity of subclass of Entity to append
	*/
	function append($entity){
		$this->entities[] = $entity;
	}

	/*
	* __toString
	* Returns a string representation of all merged entities
	* Calls __toString on each stored Entity
	*
	* @return 	string	the string representation of all entities
	*/
	function __toString(){
		$strings = array();
		foreach ($this->entities as $entity){
			$strings[] = sprintf("%s", $entity);
		}
		return implode($strings);
	}

}

?>