<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<div class="form center w100">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="mod">
		<div class="left w40">
			<div class="rowInput line">
				<?php echo $form->labelEx($model,'picture'); ?>
				<?php echo CHtml::activeFileField($model,'picture'); ?>
				<?php echo $form->error($model,'picture'); ?>
			</div>
		</div>
		<div class="left w60">
			<img src="" alt="">
			<div class="rowInput ">
				<?php echo $form->labelEx($model,'catalogueId'); ?>
				<?php echo $form->textField($model,'catalogueId'); ?>
				<?php echo $form->error($model,'catalogueId'); ?>
			</div>

			<div class="rowInput">
				<?php echo $form->labelEx($model,'author'); ?>
				<?php echo $form->textField($model,'author'); ?>
				<?php echo $form->error($model,'author'); ?>
			</div>

			<div class="rowInput">
				<?php echo $form->labelEx($model,'editor'); ?>
				<?php echo $form->textField($model,'editor',array('size'=>60,'maxlength'=>250)); ?>
				<?php echo $form->error($model,'editor'); ?>
			</div>

			<div class="rowInput w200p left pr3">
				<?php echo $form->labelEx($model,'publication'); ?>
				<?php echo $form->textField($model,'publication'); ?>
				<?php echo $form->error($model,'publication'); ?>
			</div>

			<div class="rowInput w200p left pl3">
				<?php echo $form->labelEx($model,'isbn'); ?>
				<?php echo $form->textField($model,'isbn'); ?>
				<?php echo $form->error($model,'isbn'); ?>
			</div>

			<div class="rowInput w200p">
				<?php echo $form->labelEx($model,'price'); ?>
				<?php echo $form->textField($model,'price'); ?>
				<?php echo $form->error($model,'price'); ?>
			</div>
		</div>
	</div>
	<div>
		<div class="rowInput">
				<?php echo $form->labelEx($model,'description'); ?>
				<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'description'); ?>
		</div>

		<div class="rowInput">
			<?php echo $form->labelEx($model,'epub'); ?>
			<?php echo CHtml::activeFileField($model,'epub'); ?>
			<?php echo $form->error($model,'epub'); ?>
		</div>

		<div class="rowInput buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Ajouter' : 'Modifier'); ?>
		</div>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->