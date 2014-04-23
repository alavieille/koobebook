<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/personalSelect.js',CClientScript::POS_END);
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
	<section class="etape1">
		<h4 class="pt3 ">Fichiers</h4>
		<span class="etape">Etape 1</span>
		<div class="rowInput txtcenter" id="uploadInput">
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
			<div class="personalError errorMessage mt3 txtcenter"></div>
		</div>	
		<div class="rowInput pt2">
				<?php echo CHtml::button('Étape suivante',array("id"=>"extractInfo")); ?>
		</div>
	</section>

	<section class="etape2">
	<h4 class="pt3">Informations</h4>
	<span class="etape ">Etape 2</span>
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
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="button" >Changer l'image</a>
					<a href="#" class="inbl mt1 visually-hidden" data-previewDownload="delete" >Supprimer</a>
				</nav>						
			</div>
		</div>
		<div class="left w60 tiny-w100">
			<p class="pt2">Contributeurs : </p>
			<?php foreach ($contributors as $key => $contributor) : ?> 
				<div class="rowInput line contributor">
				<p class="w200p tiny-w100"><input type="text" value="<?php echo $contributor->name ?>" name="contributor[<?php echo $key ?>][name]"  style="display:none;"></p>
				<select class="w200p" value="<?php echo $contributor->type ?>" name="contributor[<?php echo $key ?>][type]" style="display:none;">
				<option value="<?php echo $contributor->type ?>" selected="selected"></option>
				</select>			
				<p class="mt0"><?php echo $contributor->name ?> (<?php echo $contributor->translateType() ?>)<span class="pl2 deleteContrib">x</span></p></div>

			<?php endforeach; ?>
			<div class="rowInput line contributor">
				<p class="w200p inbl tiny-w100"><?php echo CHtml::textField('contributor['.count($contributors).'][name]'); ?></p>
				<?php echo CHtml::dropDownList('contributor['.count($contributors).'][type]','author',array('author'=>'Auteur','illustrator'=>'Illustrateur','traductor'=>'Traducteur'),array("class"=>"persoDropDown w200p inbl")); ?>
			</div>
			<a href="" id="addContributor">Ajouter un contributeur</a>
			<div class="rowInput line">

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

			<div class="rowInput w200p pr1 left tiny-w100 line">
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
	
	<div class="rowInput">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	
		<div class="rowInput buttons">
			<?php echo CHtml::submitButton('Ajouter'); ?>
		</div>
	</section>

	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->

