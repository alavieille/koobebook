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
		<?php //echo $form->textArea($model,'description',array('rows'=>20, 'cols'=>50)); ?>
		<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
	    'model'=>$model,
	    'autoLanguage'=> false,
	    'attribute'=>'description',
	    'filebrowserUploadUrl' => Yii::app()->baseUrl.'/lib/kcfinder/upload.php?type=files',
	    'filebrowserImageUploadUrl' =>  Yii::app()->baseUrl.'/lib/kcfinder/upload.php?type=images',
	    'toolbar' =>array(
			array('Source','-','Maximize',),
			array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat',),
			array('Link', 'Unlink',	),
			array('Image', 'HorizontalRule', 'SpecialChar'),'/',
			array('Styles', 'Format', 'FontSize'),
			array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-'),
			),
		'advancedTabs' => false,
		'uiColor' => '#E5E3E2',
		));
 		?>
		
		<?php echo $form->error($model,'description'); ?>
	</div>

	<p class="pt3">Informations de paiement (obligatoire seulement si vous desirez vendre des livres) :  </p>
	<div class="rowInput">
		<?php echo $form->labelEx($model,'namePayment'); ?>
		<?php echo $form->textField($model,'namePayment',array('placeholder'=>'ex : DUPONT Martin')); ?>
		<?php echo $form->error($model,'namePayment'); ?>
	</div>	

	<div class="rowInput">
		<?php echo $form->labelEx($model,'iban'); ?>
		<?php echo $form->textField($model,'iban',array('placeholder'=>'ex : FR7630046001290029721519546')); ?>
		<?php echo $form->error($model,'iban'); ?>
	</div>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'bic'); ?>
		<?php echo $form->textField($model,'bic',array('placeholder'=>'ex : CEPAFRPP118')); ?>
		<?php echo $form->error($model,'bic'); ?>
	</div>
	
	<div class="rowInput buttons">
		<?php echo CHtml::submitButton('Sauvegarder'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->