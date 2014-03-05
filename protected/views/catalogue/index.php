<?php
/* @var $this CatalogueController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name."- Catalogues" ;	

?>


<section class="center mt2 mod mw960p" id="indexCatalogue">
	
<h2 class="txtcenter pt2">Catalogues</h2>

<?php if(count($newCata) > 0) : ?>
	<section id="newCatalogue">
		<h3 class="mb2 ml3 mr3">Nouveautés</h3>
		<?php foreach ($newCata as $cata) : ?>
			<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
		<?php endforeach; ?>
	<section>
<?php endif; ?>


<?php if(isset($randCata)) : ?>
	<h3 class="mb2 ml3 mr3">À découvrir</h3>
	<?php  $this->renderPartial('_viewDiscover', array('cata'=>$randCata)); ?>
<?php endif; ?>


</section>
