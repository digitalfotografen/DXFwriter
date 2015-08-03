<?php
namespace DXF;

class Writer extends Collection {

	var $blocks = null;
	var $header = null;
	var $layers = null;
	var $styles = null;
	var $views = null;

	function __construct($attributes = array()){
		$defaults = array();
		$defaults['insbase'] = array(0.0, 0.0, 0.0);
		$defaults['extmin'] = array(0.0, 0.0);
		$defaults['extmax'] = array(0.0, 0.0);
		$defaults['fileName'] = 'test.dxf';
		//$defaults['tdcreate'] = time();

		parent::__construct(array_merge($defaults, $attributes));

		$this->attributes['acadver'] = "9\n\$ACADVER\n1\nAC1009\n"; //version R14

		$this->blocks = array();
		$this->header = array($this->attributes['acadver']);
		$this->layers = array(new Layer());
		$this->lineTypes = array(new LineType());
		$this->styles = array(new Style());
		$this->views = array();

		//echo print_r($this->attributes);
	}
	/*
	* Helper function for self._point
	*/
	function name($name){
		return sprintf("9\n\$%s\n", strtoupper($name));
	}

	/*
	* Point setting from drawing like extmin,extmax,...
	*/
	function point($name, $x){
		return sprintf("%s%s", $this->name($name), point($x));
	}

	/*
	* Sections like tables,blocks,entities,...
	*/
	function section($name, $x = null){
		$xstr = is_array($x) && count($x) ? implode($this->stringArray($x)) : '';
		return sprintf("0\nSECTION\n2\n%s\n%s0\nENDSEC", strtoupper($name), $xstr);
	}

	/*
	* Tables like ltype,layer,style,...
	*/
	function table($name, $x = null){
		$xstr = isset($x) ? implode($this->stringArray($x),"\n") : '';
		return sprintf("0\nTABLE\n2\n%s\n70\n%d\n%s\n0\nENDTAB\n", strtoupper($name), count($x), $xstr);
	}

	function appendBlock($block){
		$this->blocks[] = $block;
	}

	function appendHeader($header){
		$this->header[] = $header;
	}

	function appendLayer($layer){
		$this->layers[] = $layer;
	}

	function appendLineType($lineType){
		$this->lineTypes[] = $lineType;
	}

	function appendStyle($style){
		$this->styles[] = $style;
	}

	function appendView($view){
		$this->views[] = $view;
	}

	function setAttribute($name, $value){
		$this->attributes[$name] = $value;
	}

	/*
	* Returns drawing as dxf string.
	*/
	function __toString(){

		$this->header[] = $this->point('insbase', $this->attributes['insbase']);
		$this->header[] = $this->point('extmin', $this->attributes['extmin']);
		$this->header[] = $this->point('extmax', $this->attributes['extmax']);
		//$this->header[] = $this->point('extmax', $this->attributes['extmax']);
		//$this->header[] = sprintf("9\n\$%s\n40\n%s\n",'TDCREATE', tdDate($this->attributes['tdcreate']));
		$header = $this->section('header', $this->header);

		$tables = array();
		$tables[] = $this->table('ltype', $this->stringArray($this->lineTypes) );
		$tables[] = $this->table('layer', $this->stringArray($this->layers) );
		$tables[] = $this->table('style', $this->stringArray($this->styles) );
		$tables[] = $this->table('view', $this->stringArray($this->views) );
		$tables = $this->section('tables', $tables);

		$blocks = $this->section('blocks', $this->blocks);
		$entities = $this->section('entities', $this->entities);

		return implode("\n", array($header, $tables, $blocks, $entities, "0\nEOF\n"));
	}

	function saveAs($fileName){
		$this->attributes['fileName'] = $fileName;
		$this->save();
	}

	function save(){
		$fh = fopen($this->attributes['fileName'], 'w');
		fwrite($fh, sprintf("%s", $this));
		fclose($fh);
	}
}#