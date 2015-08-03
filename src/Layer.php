<?php
require_once 'BaseClass.php';

/**
* Layer
* 
* Used attributes
* name default 'dxfwriter'
* flag default 64
* color default 7
* lineType default 'continuous'
*/

class DxfLayer extends DxfBaseClass{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['name'] = 'dxfwriter';
		$defaults['flag'] = 64;
		$defaults['color'] = 7;
		$defaults['lineType'] = 'continuous';
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* __toString
	* Returns a string representation of layer
	* @return 	string	the string representation of this layer
	*/
	function __toString(){
		// TODO all are string values, maybee som should be decimal
		return sprintf("0\nLAYER\n2\n%s\n70\n%s\n62\n%s\n6\n%s",
									$this->attributes['name'],
									$this->attributes['flag'],
									$this->attributes['color'],
									$this->attributes['lineType']
				);
	}
}
?>