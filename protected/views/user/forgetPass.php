<?php
/* @var $this userController */
/* @var $model ForgetPassForm */

$this->pageTitle=Yii::app()->name . ' - Mot de passe oublié';
?>

<h2 class="txtcenter pt2 pb1 ">Mot de passe oublié</h2>

<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="txtcenter flasherror  pa1 mb2 small-w100 w80 center mw960p">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<p class="txtcenter mb3 pb2 center w700p">Pour réinitialiser votre 
mot de passe, saisissez l'adresse e-mail que vous utilisez pour vous 
connecter à votre compte. Un nouveau mot de passe 
vous sera envoyé, 
attention il ne sera valable que pendant 30 minutes.</p>


<div class="form w400p center pa1" >
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'forget-form',
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

    <div class="rowInput buttons">
        <?php echo CHtml::submitButton('Valider'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
