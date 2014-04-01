<?php
/* @var $this CatalogueController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name."- Catalogues" ;	
$this->breadcrumbs=array(
	    'Catalogues'=>array('Catalogue/index'),	
);

?>


<section class="mod pt2" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($newCata) > 0) : ?>
		<section id="newCatalogue">
			<h3 class="mb2 mr3">
				<a class=" w100 icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/new/');  ?>">Nouveautés</a>
			</h3>
			<?php foreach ($newCata as $cata) : ?>
				<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>
	</div>


<?php if(isset($randCata)) : ?>
	<section id="discoverCatalogue" class="pa2 catalogue">
		<div class="center mw960p">
			<h3 class="mb2 mr3">À découvrir</h3>
			<?php  $this->renderPartial('_viewDiscover', array('cata'=>$randCata)); ?>
		</div>
	</section>
<?php endif; ?>

<?php if(isset($topCata)) : ?>
	<div class="center mw960p">	
		<?php if(count($topCata) > 0) : ?>
		<section id="newCatalogue">
			<h3 class="mb2 mr3">
				<a class=" w100 icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/topDownload/');  ?>">Top téléchargement</a>
			</h3>
			<?php foreach ($topCata as $cata) : ?>
				<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>
	</div>

<?php endif; ?>
	

</section>
