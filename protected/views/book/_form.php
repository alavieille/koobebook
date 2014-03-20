<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/book.js',CClientScript::POS_END);
?>
				
<div class="form w100 center">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableClientValidation'=>true,

)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subtitle'); ?>
		<?php echo $form->textField($model,'subtitle'); ?>
		<?php echo $form->error($model,'subtitle'); ?>
	</div>

	<div class="mod">
		<div class="left w40 tiny-w100">
			<div class="rowInput line pr1 ">
				<?php echo $form->labelEx($model,'pictureFile'); ?>

				<img class="mt1 mb1 center visually-hidden" data-previewDownload="preview" id="previous_cover" src="<?php echo Yii::app()->request->baseUrl.'/images/default_cover.png' ?>" alt="apercu de la couverture" >
				<?php echo CHtml::activeFileField($model,'pictureFile',array("data-previewDownload"=>"input")); ?>
				<?php echo $form->error($model,'pictureFile') ?>
				<div data-previewdownload="error" class="errorMessage" id="Book_pictureFile_em_"></div>
				<nav class="inputPicture"> 
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="button" >Modifier</a>
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="delete" >Supprimer</a>
				</nav>						
			</div>
		</div>
		<div class="left w60 tiny-w100">
			<div class="rowInput">
				<?php echo $form->labelEx($model,'author'); ?>
				<?php echo $form->textField($model,'author'); ?>
				<?php echo $form->error($model,'author'); ?>
			</div>

			<div class="rowInput">
				<?php echo $form->labelEx($model,'editor'); ?>
				<?php //echo $form->textField($model,'editor',array('size'=>60,'maxlength'=>250)); ?>
				<p><?php echo $model->catalogue->name ?></p>
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
						'dateFormat'=>'yy-mm-dd',
				    	),
				    'htmlOptions' => array(
				       // 'class' => 'visually-hidden'  // textField maxlength
				    ),
				));

				?>
				<?php echo $form->error($model,'publication'); ?>
			</div>

			<div class="rowInput w200p left  tiny-w100">
				<?php echo $form->labelEx($model,'language'); ?> 
				<?php echo $form->textField($model,'language'); ?>
				<?php echo $form->error($model,'language'); ?>
			</div>

			<div class="rowInput w200p pr1 left tiny-w100">
				<?php echo $form->labelEx($model,'price'); ?> 
				<?php echo $form->textField($model,'price'); ?>
				<?php echo $form->error($model,'price'); ?>
			</div>

			<div class="rowInput w200p left tiny-w100">
				<?php echo $form->labelEx($model,'isbn'); ?>
				<?php echo $form->textField($model,'isbn'); ?>
				<?php echo $form->error($model,'isbn'); ?>
			</div>


		</div>
	</div>
	<div>
		<div class="rowInput">
				<?php echo $form->labelEx($model,'description'); ?>
				<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'description'); ?>
		</div>

		<div class="rowInput" id="uploadInput">
			<?php echo $form->labelEx($model,'bookFile1'); ?>
			<?php echo CHtml::activeFileField($model,'bookFile1',array("class"=>"visually-hidden")); ?>
			<?php echo CHtml::activeFileField($model,'bookFile2',array("class"=>"visually-hidden")); ?>
			<?php echo CHtml::activeFileField($model,'bookFile3',array("class"=>"visually-hidden")); ?>
			<ul class='mb1'>
				<li class="Book_bookFile1" >
					<p></p>
				</li>
				<li class="Book_bookFile2">
					<p></p>
				</li>
				<li class="Book_bookFile3">
					<p></p>
				</li>
			</ul>
			
			
			<?php echo $form->error($model,'bookFile1'); ?>
			<div class="personalError errorMessage"></div>
		</div>		


		<div class="rowInput buttons">
			<?php echo CHtml::submitButton('Ajouter'); ?>
		</div>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->

