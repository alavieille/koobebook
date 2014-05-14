<section>
	<h5 class="w100 mb2 mr3 pl1">
		<a class="icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>$type,'query'=>$query));  ?>">Livres <span class="nbr">(<?php echo count($books) ?> résultats )</span></a>
	</h5>
	<div class="autogrid5 catalogue">
	<?php foreach (array_slice($books, 0, 10) as $book) : ?>
				<?php  $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book)); ?>
	<?php endforeach; ?>
	</div>
</section>