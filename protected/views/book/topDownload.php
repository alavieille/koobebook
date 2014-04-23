<?php
/* @var $this BookController */
$this->pageTitle=Yii::app()->name."- Top téléchargement" ;

$this->breadcrumbs=array(
	    'Top téléchargement'=>array('Book/topDownload'),
);
?>

<section class="mod pt2" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($topBook) > 0) : ?>
		<section id="topDownload">
			<h3 class="mb2 mr3 pl1">Top téléchargement</h3>
			<div class="autogrid5 catalogue">
			<?php foreach ($topBook as $book) : ?>
				<?php  $this->renderPartial('_viewBookCatalogue', array('book'=>$book)); ?>
			<?php endforeach; ?>
			</div>
		<section>
		<?php endif; ?>

	</div>

</section>