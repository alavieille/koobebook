<?php
$this->pageTitle=Yii::app()->name . ' - Bibliothèque';
?>

<h2 class="pt2 pb1">Ma bibliothèque</h2>
<section class="w100 pa1 mb3 catalogue" id="library">

	<?php if(count($model) == 0 ) : ?>
		
		<p class="txtcenter pa2">Vous n'avez aucun ebook dans votre bibliothèque</p>

		<?php endif; ?>
		<div class="autogrid5">
			<?php foreach ($model as $book) :?>
				<?php $this->renderPartial('//book/_viewBookLibrary', array('book'=>$book->book)); ?>
			<?php endforeach; ?>
		</div>
</section>