<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Créer';
?>

<h2 class="txtcenter pt2 pb1">Créer mon catalogue</h2>
<p class="txtcenter center w500p mb2">
	Que vous soyez un éditeur ou un auteur, vous pouvez créer votre catalogue pour diffuser vos livre numérique.
	Pour plus de détail consulté la page d'aide.
</p>
<div class="form w400p center">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalogue-form',
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class="rowInput">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Créer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->