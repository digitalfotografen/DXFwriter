<?php
// test code for DFXwriter

require 'DXFwriter.php';

$d = new Drawing();

$b = new Block(array('name' => 'test'));
$b->append(new Solid(array('points' => array(array(0, 0, 0),
											array(1, 0, 0), 
											array(1, 1, 0), 
											array(0, 1, 0)),
            				'color' => 1)
));

$b->append(new Arc( array('center'=>array(1,0,0), 'color' => 2) ));
$d->appendBlock($b);

$d->appendStyle(new Style());
$d->appendView(new View(array('name' =>'Normal')));
$d->appendView(ViewByWindow('Window', array(1,0), array(2,1)));
$d->append(new Circle(array('center' => array(1, 1, 0), 'color'=>3)));
$d->append(new Face(array('points'=>array(array(0, 0, 0), 
										array(1, 0, 0), 
										array(1, 1, 0), 
										array(0, 1, 0)),
							'color'=>4)
));
$d->append(new Insert(array('name'=>'test', 
							'point'=>array(3, 3, 3), 
							'cols'=>5, 
							'colspacing'=>2)));
$d->append(new Line(array('points'=>array(array(0, 0, 0), 
										array(1, 1, 1)))));
$d->append(new LwPolyLine(array('points'=>array(array(0, 0, 0),
										array(1, 1, 0), 
										array(1, 0, 0), 
										array(0, 1, 0)),
            				'closed'=>1,
            				'color'=>7,
            				'width'=>1)
));
$d->append(new PolyLine(array('points'=>array(array(1, 1, 1),
										array(2, 1, 1), 
										array(2, 2, 1), 
										array(1, 2, 1)),
            				'closed'=>1,
            				'color'=>1)
));
$d->append(new Point(array('point' => array(1, 1, 0), 'color'=>1)));
$d->append(new Solid(array('points' => array(array(4, 4, 0),
										array(5, 4, 0),
										array(7, 8, 0),
										array(9, 9, 0)),
							'color' => 3)
));
$d->append(new Text(array('text' => 'Please donate!', 
						'point' => array(3, 0, 1)
)));
$d->saveAs('test.dxf');

?>