<?php
require_once 'BaseClass.php';

/*
* Style - Text style
* 
* Used attributes
* name default 'standard'
* flag default 0
* height default 0
* widthFactor default 40
* obliqueAngle default 50
* mirror default 0
* lastHeight default 1
* font default 'arial.ttf'
* bigFont default ''
*
*/

class DxfStyle extends DxfBaseClass{

	/*
	* Constructor
	* It is recommended that sublasses calls parent::__construct($attributes)
	* after setting default attributes 
	*
	* @param  Array	$attributes	array of attributes
	*/
	function __construct($attributes = array()){
		$defaults = array();
		$defaults['name'] = 'standard';
		$defaults['flag'] = 0;
		$defaults['height'] = 0;
		$defaults['widthFactor'] = 40;
		$defaults['obliqueAngle'] = 50;
		$defaults['mirror'] = 0;
		$defaults['lastHeight'] = 1;
		$defaults['font'] = 'arial.ttf';
		$defaults['bigFont'] = '';
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* __toString
	* Returns a string representation of layer
	* @return 	string	the string representation of this layer
	*/
	function __toString(){
		// TODO all are string values, maybee som should be decimal
		return sprintf("0\nSTYLE\n2\n%s\n70\n%s\n40\n%s\n41\n%s\n50\n%s\n71\n%s\n42\n%s\n3\n%s\n4\n%s",
									strtoupper($this->attributes['name']),
									$this->attributes['flag'],
									$this->attributes['flag'],
									$this->attributes['widthFactor'],
									$this->attributes['obliqueAngle'],
									$this->attributes['mirror'],
									$this->attributes['lastHeight'],
									strtoupper($this->attributes['font']),
									strtoupper($this->attributes['bigFont']));
	}
}
?>