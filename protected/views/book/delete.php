<?php
/* @var $this BookController */


$this->pageTitle=Yii::app()->name . ' - Supprimer';
?>
<h2 class="pt2 mb2">Supprimer</h2>
<section class="center w500p">
<p class="txtcenter">Etes vous sur de vouloir supprimer ce ebook de votre catalogue : </p>
<p class="txtcenter h5-like"><?php echo $model->title; ?></p>
<p class="txtcenter mt2">(attention le ebook sera seulement supprimer de votre catalogue, les fichiers (epub,mobi,pdf) seront conservés dans la biliothèque des utilisateurs possédant déjà le ebook).</p>
<p class="txtcenter">
<?php
echo CHtml::link(
    'Supprimer ce ebook',
     array('book/confirmDelete','id'=>$model->id),
     array('confirm' => 'Etes vous sur ?','class'=>'h4-like pa3 inbl')

);
?>
</p>
<p class="txtcenter"><a href="<?php echo Yii::app()->request->urlReferrer; ?>">Annuler</a></p>
</section>