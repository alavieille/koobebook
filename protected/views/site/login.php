<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>
<h2 class="txtcenter pt2 pb1 ">Connexion</h2>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="txtcenter flashsuccess pb2">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="form w100 center" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo  $form->errorSummary($model); ?>
	<?php echo $form->error($model,'email'); ?>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array("class"=>"icon icon-mail")); ?>

	</div>

	<div class="rowInput">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		
	</div>

	<div class="rowInput rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
	</div>

	<div class="rowInput buttons pb3">
		<?php echo CHtml::submitButton('Connexion'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<p class="txtcenter mt3 w100"><?php echo CHtml::link('Mot de passe oublié ?',array('user/Forget'),array('class'=>'pa3')); ?></p>