<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */

$this->breadcrumbs=array(
	'Catalogues'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Catalogue', 'url'=>array('index')),
	array('label'=>'Create Catalogue', 'url'=>array('create')),
	array('label'=>'Update Catalogue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Catalogue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Catalogue', 'url'=>array('admin')),
);
?>

<h1>View Catalogue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'name',
		'firstName',
		'description',
	),
)); ?>
