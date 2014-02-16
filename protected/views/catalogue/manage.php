<?php
/* @var $this CatalogueController */
/* @var $model Manage */
$this->pageTitle=Yii::app()->name . ' - Mise a jour';

?>

<h2 class="pt2 pb1 txtcenter">Gérer</h2>
<section id="ltBook" class="knacss-debug w100 autogrid3">
<h4>Vos livres</h4>
<?php foreach ($model->books as $book) :?>

	<div class="">
		<a href="">
		<?php 
 		$picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
 		if(! is_null($book->picture)){
 			$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR.$book->id."-".$book->picture;
 		}
		?>
		<img class="w100p" src="<?php echo $picture; ?>" alt="couverture">
		<p class="w100 pl1 pr1"><?php echo $book->title;?></p>		
		</a>
	</div>
<?php endforeach; ?>
</section>

<div class="autogrid3">  <!-- 3 columns  -->
  <div>lorem ipsum</div>
  <div>lorem ipsum</div>
  <div>lorem ipsum</div>
  <div>lorem ipsum</div>
  <div>lorem ipsum</div>
  <div>lorem ipsum</div>
</div>