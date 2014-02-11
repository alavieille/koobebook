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

<h2 class="pt2 pb1">Mise à jour</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<h2 class="pt2 pb1">Suppression</h2>
<p class="txtcenter h6-like pb3">
	<a href="<?php echo $this->createUrl('catalogue/delete/'.$model->id); ?>">Supprimer mon catalogue</a>	
</p>