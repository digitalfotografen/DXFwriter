<?php
namespace DXF;

class Output_Test extends \PHPUnit_Framework_TestCase {

public function testWriterOutputsFile() {
	$filePath = sys_get_temp_dir() . "/test.dxf";

	$writer = new Writer();
	$writer->saveAs($filePath);

	$this->assertFileExists($filePath);
	$contents = file_get_contents($filePath);

	$this->assertStringStartsWith("0\nSECTION", $contents);
	$this->assertStringEndsWith("0\nEOF\n", $contents);
}

}#