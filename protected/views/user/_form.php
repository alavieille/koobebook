<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form w100 center">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
//	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array('maxlength'=>128, "placeholder"=>"example@mail.com")); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('maxlength'=>128, "value"=>"")); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>	

	<div class="rowInput">
		<?php echo $form->labelEx($model,'passwordConfirm'); ?>
		<?php echo $form->passwordField($model,'passwordConfirm',array('maxlength'=>128)); ?>
		<?php echo $form->error($model,'passwordConfirm'); ?>
	</div>

	<div class="rowInput buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Valider' : 'Sauvegarder'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->