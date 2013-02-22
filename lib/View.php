<?php
require_once 'BaseClass.php';

/*
* View
* 
* Used attributes
* name default 'standard'
* flag default 0
* width default 1
* height default 1
* center default array(0.5, 0.5)
* direction default array(0, 0, 1)
* target default array(0, 0, 0)
* lens default 50
* frontClipping default 0
* backClipping default 0'
* mode default 0
*
*/

class DxfView extends DxfBaseClass{

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
		$defaults['width'] = 1;
		$defaults['height'] = 1;
		$defaults['center'] = array(0.5, 0.5);
		$defaults['direction'] = array(0, 0, 1);
		$defaults['target'] = array(0, 0, 0);
		$defaults['lens'] = 50;
		$defaults['frontClipping'] = 0;
		$defaults['backClipping'] = 0;
		$defaults['twist'] = 0;
		$defaults['mode'] = 0;
		parent::__construct(array_merge($defaults, $attributes));
	}

	/*
	* __toString
	* Returns a string representation of layer
	* @return 	string	the string representation of this layer
	*/
	function __toString(){
		// TODO all are string values, maybee som should be decimal
		return sprintf("0\nVIEW\n2\n%s\n70\n%s\n40\n%s\n%s41\n%s\n%s%s42\n%s\n43\n%s\n44\n%s\n50\n%s\n71\n%s",
									$this->attributes['name'],
									$this->attributes['flag'],
									$this->attributes['height'],
									point($this->attributes['center']),
									$this->attributes['width'],
									point($this->attributes['direction'], 1),
									point($this->attributes['target'], 2),
									$this->attributes['lens'],
									$this->attributes['frontClipping'],
									$this->attributes['backClipping'],
									$this->attributes['twist'],
									$this->attributes['mode']
				);
	}
}

// helper function to generate view window
function DxfViewByWindow($name, 
						$leftBottom = array(0,0),
						$rightTop = array(1,1),
						$attributes = array()){

		$defaults['name'] = $name;
		$defaults['width'] = abs($rightTop[0] - $leftBottom[0]);
		$defaults['height'] = abs($rightTop[1] - $leftBottom[1]);
		$defaults['center'] = array(0.5*($rightTop[0] + $leftBottom[0]),
									0.5*($rightTop[1] + $leftBottom[1]));

	return new DxfView(array_merge($defaults, $attributes));
}
?>