<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Mise a jour';
$this->breadcrumbs=array(
	'Catalogues'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Catalogue', 'url'=>array('index')),
	array('label'=>'Create Catalogue', 'url'=>array('create')),
	array('label'=>'View Catalogue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Catalogue', 'url'=>array('admin')),
);

?>

<h1>Update Catalogue <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>