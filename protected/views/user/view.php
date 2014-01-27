<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);
?>

<h2 class="txtcenter">Profil</h2>

<?php $this->renderPartial('_view', array('data'=>$model)); ?>
