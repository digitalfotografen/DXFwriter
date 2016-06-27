<?php
namespace DXF;

class ObjectTypes_Test extends \PHPUnit_Framework_TestCase {

/**
 * This is the most basic test, to assert that the Writer class is autoloaded
 * correctly by Composer.
 */
public function testWriterConstructs() {
	$writer = new Writer();
	$this->assertInstanceOf("\DXF\Writer", $writer);
}

}#