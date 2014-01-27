<?php
/* @var $this UserController */


$this->pageTitle=Yii::app()->name . ' - Supprimer';
?>
<section class="center w500p">
<h2 class="txtcenter pt2 pb1">Supprimer</h2>
<p class="txtcenter">Si vous supprimer votre compte, toutes les données concernant celui-ci seront supprimé définitivement.</p>

<p class="txtcenter">
<?php
echo CHtml::link(
    'Supprimer mon compte',
     array('user/confirmDelete','id'=>$id),
     array('confirm' => 'Etes vous sur ?','class'=>'h4-like pa3 inbl')

);
?>
</p>
</section>