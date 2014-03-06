<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
/* @var $form CActiveForm */
?>

<div class="form ">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalogue-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class="rowInput w300p">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="rowInput">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>20, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	
	<div class="rowInput buttons">
		<?php echo CHtml::submitButton('Sauvegarder'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->