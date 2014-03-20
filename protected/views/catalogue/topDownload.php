<?php

$this->pageTitle=Yii::app()->name."- Top téléchargement" ;

$this->breadcrumbs=array(
	    'Catalogue'=>array('Catalogue'),
	    'Top téléchargement'=>array('Catalogue/topDownload'),
	
);
?>

<section class="mod pt2" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($allTopCata) > 0) : ?>
		<section id="newCatalogue">
			<h3 class="mb2 mr3">Nouveautés</h3>
			<?php foreach ($allTopCata as $cata) : ?>
				<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>

	</div>

</section>