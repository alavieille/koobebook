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
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="mod">
		<div class="left w40 tiny-w100">
			<div class="rowInput line pr1 ">
				<?php echo $form->labelEx($model,'picture'); ?>
				<img class="mt1 mb1 center visually-hidden" data-previewDownload="preview" id="previous_cover" src="<?php echo Yii::app()->request->baseUrl; ?>/images/default_cover.png" alt="apercu de la couverture" >
				<?php echo CHtml::activeFileField($model,'picture',array("data-previewDownload"=>"input")); ?>
				<?php echo $form->error($model,'picture',array("data-previewDownload"=>"error")); ?>
				<nav class="inputPicture"> 
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="button" >Modifier</a>
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="delete" >Supprimer</a>
				</nav>
				
				
			</div>
		</div>
		<div class="left w60 tiny-w100">
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

			<div class="rowInput w200p left pr1 tiny-w100">
				<?php echo $form->labelEx($model,'publication'); ?>
				<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'model' => $model,
				    'attribute' => 'publication',
				    'language' => 'fr',
				    'options' => array(

				    	),
				    'htmlOptions' => array(
				       // 'class' => 'visually-hidden'  // textField maxlength
				    ),
				));

				?>
				<?php echo $form->error($model,'publication'); ?>
			</div>

			<div class="rowInput w200p left tiny-w100">
				<?php echo $form->labelEx($model,'isbn'); ?>
				<?php echo $form->textField($model,'isbn'); ?>
				<?php echo $form->error($model,'isbn'); ?>
			</div>

			<div class="rowInput w200p tiny-w100">
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