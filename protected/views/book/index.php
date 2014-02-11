<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Books',
);

$this->menu=array(
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>Livre</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'book-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		'title',
		'price',
		'author',
		'editor',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
))

; ?>