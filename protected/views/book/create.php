<?php
/* @var $this BookController */
/* @var $model Book */
$this->pageTitle=Yii::app()->name . ' - créer';
?>

<h2 class="txtcenter pt2 pb1">Ajouter un livre</h2>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>