<?php
// test code for DFXwriter

require 'DXFwriter.php';

$d = new DxfWriter();

$b = new DxfBlock(array('name' => 'test'));
$b->append(new DxfSolid(array('points' => array(array(0, 0, 0),
											array(1, 0, 0), 
											array(1, 1, 0), 
											array(0, 1, 0)),
            				'color' => 1)
));

$b->append(new DxfArc( array('center'=>array(1,0,0), 'color' => 2) ));
$d->appendBlock($b);

$d->appendStyle(new DxfStyle());
$d->appendView(new DxfView(array('name' =>'Normal')));
$d->appendView(DxfViewByWindow('Window', array(1,0), array(2,1)));
$d->append(new DxfCircle(array('center' => array(1, 1, 0), 'color'=>3)));
$d->append(new DxfFace(array('points'=>array(array(0, 0, 0), 
										array(1, 0, 0), 
										array(1, 1, 0), 
										array(0, 1, 0)),
							'color'=>4)
));
$d->append(new DxfInsert(array('name'=>'test', 
							'point'=>array(3, 3, 3), 
							'cols'=>5, 
							'colspacing'=>2)));
$d->append(new DxfLine(array('points'=>array(array(0, 0, 0), 
										array(1, 1, 1)))));
$d->append(new DxfLwPolyLine(array('points'=>array(array(0, 0, 0),
										array(1, 1, 0), 
										array(1, 0, 0), 
										array(0, 1, 0)),
            				'closed'=>1,
            				'color'=>7,
            				'width'=>1)
));
$d->append(new DxfPolyLine(array('points'=>array(array(1, 1, 1),
										array(2, 1, 1), 
										array(2, 2, 1), 
										array(1, 2, 1)),
            				'closed'=>1,
            				'color'=>1)
));
$d->append(new DxfPoint(array('point' => array(1, 1, 0), 'color'=>1)));
$d->append(new DxfSolid(array('points' => array(array(4, 4, 0),
										array(5, 4, 0),
										array(7, 8, 0),
										array(9, 9, 0)),
							'color' => 3)
));
$d->append(new DxfText(array('text' => 'Please donate!', 
						'point' => array(3, 0, 1)
)));
$d->saveAs('test.dxf');

?>