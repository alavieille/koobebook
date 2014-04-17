<?php
/* @var $this CatalogueController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name."- Éditeurs" ;	
$this->breadcrumbs=array(
	    'Éditeurs'=>array('Catalogue/index'),	
);

?>
<?php  $this->renderPartial('//catalogue/_viewIndex', array('newCata'=>$newCata,'randCata'=>$randCata,'topBook'=>$topBook)); ?>
