<?php
/* @var $this CatalogueController */
/* @var $model Manage */
$this->pageTitle=Yii::app()->name . ' - Mise a jour';

?>

<h2 class="pt2 pb1 txtcenter">Gérer</h2>
<section id="ltBook" class="w100 pa1">
<h4 class="pb1 mb1 w100">Vos ebooks</h4>
<div class="autogrid4">
	<div class="center ml1 mb2 mr1 mt2 w150p small-w100" id="addEbook">
		<a class="center" href="<?php echo Yii::app()->createUrl('book/create/'); ?>">
			<p id="iconAdd" class="txtcenter">+</p>
			<p class="txtcenter ma0">Ajouter un livre</p>
		</a>
	</div>
<?php foreach ($model->books as $book) :?>

	<div class="mb2 mr1">
		<a href="<?php echo Yii::app()->createUrl('book/view/',array( 'id'=>$book->id)); ?>">
		<?php 
 		$picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
 		if(! is_null($book->picture)){
 			$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR.$book->id."-".$book->picture;
 		}
		?>
		<figure class="txtcenter pt1">
			<img class="" src="<?php echo $picture; ?>" alt="couverture">
			<figcaption>
				<p class="pt1 w100 txtcenter"><?php echo $book->title;?></p>		
			</figcaption>
		</figure>
		</a>
	</div>
	
<?php endforeach; ?>
</div>
</section>
