<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle=Yii::app()->name . ' - Mise à jour';
?>
<h2 class="txtcenter pt2 pb1 ">Mon compte</h2>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>