
<section class="pa2 pb0 pt3 viewNew catalogue">
	<a class="w100 link" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata["catalogue"]->id)); ?> ">
		<h4 class="name inbl pr2 pb1">Éditions <?php echo ucfirst($cata["catalogue"]->name) ?></h4>
		<p class="inbl mt0 icon icon-bracket2 after">Découvrir le catalogue de l'éditeur<p>
	</a>
	<div class=" center autogrid5 mb0 line">
		<?php foreach ($cata["books"] as $book) : ?>
			<?php  $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book)); ?>
		<?php endforeach; ?>
	</div>
</section>