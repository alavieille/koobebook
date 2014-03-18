<?php
/* @var $this CatalogueController */


$this->pageTitle=Yii::app()->name . ' - Supprimer';
?>
<section class="center w500p">
<h2 class="txtcenter pt2 pb1">Supprimer</h2>
<p class="txtcenter">Si vous supprimer votre catalogue, toutes les données concernant celui-ci seront supprimé définitivement.</p>
<p class="txtcenter">Toutefois vos différents ebooks de votre catalogue seront conservés dans les biliothèques des utilisateurs possédant déjà ces ebooks</p>
<p class="txtcenter">
<?php
echo CHtml::link(
    'Supprimer mon catalogue',
     array('catalogue/confirmDelete','id'=>$id),
     array('confirm' => 'Etes vous sur ?','class'=>'h4-like pa3 inbl')

);
?>
</p>
</section>