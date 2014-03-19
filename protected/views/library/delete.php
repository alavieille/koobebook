<?php
$this->pageTitle=Yii::app()->name . ' - Supprimer';
?>
<section class="center w500p">
<h2 class="txtcenter pt2 pb1">Confirmation</h2>
<p class="txtcenter">Etes vous sur de vouloir supprimer ce ebook de votre bibliothèque ?</p>
<p class="txtcenter">
<?php
echo CHtml::link(
    'Supprimer le ebook de votre bibliothèque',
     array('library/confirmDelete','id'=>$id),
     array('confirm' => 'Etes vous sur ?','class'=>'h4-like pa3 inbl')

);
?>
</p>
</section>