<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
?>

<h2 class="txtcenter pt2 pb1">Créer mon catalogue</h2>
<p class="txtcenter center w500p mb2">
	Que vous soyez un éditeur ou un auteur, vous pouvez créer votre catalogue pour diffuser vos livre numérique.
	Pour plus de détail consulté la page d'aide.
</p>
<div class="form w100 center">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalogue-form',
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowInput">
 		<p class='inbl labelCheckboxList'>Etes-vous ? :</p>

		<input name="type" id="form_editeur" value="editeur" type="radio" class="inbl" checked/>		
		<label  class="inbl ml1" for="form_editeur">Editeur</label>


		<input  class="inbl" name="type" id="form_auteur" value="auteur" type="radio" />		
		<label  class="inbl ml1" for="form_auteur">Auteur</label>

	</div>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Créer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->