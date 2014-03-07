<?php
/* @var $this BookController */
/* @var $model Book */
$this->pageTitle=Yii::app()->name . ' - Mise à jour';
?>

<h2 class="txtcenter pt2 pb1" >Mise à jour</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>