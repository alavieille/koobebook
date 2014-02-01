<?php
/* @var $this CatalogueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catalogues',
);

$this->menu=array(
	array('label'=>'Create Catalogue', 'url'=>array('create')),
	array('label'=>'Manage Catalogue', 'url'=>array('admin')),
);
?>

<h1>Catalogues</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
