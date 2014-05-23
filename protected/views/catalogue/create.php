<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Créer';
?>

<h2 class="txtcenter pt2 pb1">Créer mon catalogue</h2>
<p class=" center w800p mb2">
	Que vous soyez un éditeur ou un auteur, vous pouvez créer votre catalogue pour diffuser vos livre numérique.
	Pour plus de détail consulté la page d'aide.
</p>
<div class="form w800p center">

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

	<p class="pt3">Informations de paiement (obligatoire seulement si vous desirez vendre des livres) : </p>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton('Créer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->