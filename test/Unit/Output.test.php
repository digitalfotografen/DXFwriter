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

public function testFullOutput() {
	$writer = new Writer();

	$b = new Block(array('name' => 'test'));
	$b->append(new Solid(array('points' => array(array(0, 0),
												array(1, 0),
												array(1, 1),
												array(0, 1)),
	            				'color' => 1)
	));

	$b->append(new Arc( array('center'=>array(1,0), 'color' => 2) ));
	$writer->appendBlock($b);

	$writer->appendStyle(new Style());
	$writer->appendView(new View(array('name' =>'Normal')));
	$writer->appendView(View::byWindow('Window', array(1,0), array(2,1)));

	$writer->appendLineType(new LineType(array(
			'name' => 'DASHED',
			'description' => '- - -',
			'elements' => array(
				array('length' => 0.8),
				array('length' => -0.2)
			)
	)));

	$writer->append(new Circle(array('center' => array(1, 1), 'color'=>3)));
	$writer->append(new Face(array('points'=>array(array(0, 0),
											array(1, 0),
											array(1, 1),
											array(0, 1)),
								'color'=>4)
	));


	$writer->append(new Insert(array('name'=>'test',
								'point'=>array(3, 3),
								'cols'=>5,
								'colspacing'=>2)));

	$writer->append(new Line(array('lineType'=>'DASHED',
								'points'=>array(array(0, 0),
											array(5, 5))
	)));

	/*
	$writer->append(new LwPolyLine(array('points'=>array(array(0, 0),
											array(1, 0),
											array(1, 1),
											array(0, 1)),
	            				'flag'=>129,
	            				'layer' => "Writer",
	            				'color'=>7,
	            				'width'=>1,
	            				'lineType'=>'CONTINUOUS',
	            				'lineWeight' => 0)
	));
	*/

	$writer->append(new PolyLine(array('points'=>array(array(1, 1),
											array(20, 10),
											array(20, 20),
											array(1, 15)),
	            				'lineType'=>'DASHED',
	            				'flag' => 0
	            				//'width' => 1,
	            				//'color'=>1
	            				)
	));


	$writer->append(new Point(array('point' => array(1, 1), 'color'=>1)));
	$writer->append(new Solid(array('points' => array(array(4, 4),
											array(5, 4),
											array(7, 8),
											array(9, 9)),
								'color' => 3)
	));
	$writer->append(new Text(array('text' => 'Testing testing!',
							'point' => array(3, 0)
	)));

	$filePath = sys_get_temp_dir() . "/test.dxf";
	$writer->saveAs($filePath);
	$this->assertFileExists($filePath);
	// TODO: Test contents of file.
}

}#