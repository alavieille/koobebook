<?php
/* @var $this UserController */
/* @var $model User */


$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h2 class="txtcenter pt2 pb1">Inscription</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>