<section class="pa2 pt0 pb1 viewNew">
	<a class="w100" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata["catalogue"]->id)); ?> ">
		<h4 class="name inbl pr2"><?php echo ucfirst($cata["catalogue"]->name) ?></h4>
		<p class="inbl mt0 icon icon-bracket2 after">Découvrir le catalogue<p>
	</a>
	<div class=" mt2 center autogrid5 mb0 line">
		<?php foreach ($cata["books"] as $book) : ?>
			<?php  $this->renderPartial('//catalogue/_viewBook', array('book'=>$book)); ?>
		<?php endforeach; ?>
	</div>
</section>