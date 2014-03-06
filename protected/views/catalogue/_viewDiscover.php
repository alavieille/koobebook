
<a href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata->id)); ?> ">
	<h4 class="name inbl"><?php echo ucfirst($cata->name) ?></h4>
	<a  class="ml2 inbl icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata->id)); ?> ">Découvrir le catalogue</a>
	<p class="description mt1 mb3"><?php echo $cata->getExcerptDescription(400) ?></p>
</a>
<div class=" center autogrid5 mb0 books small-hidden">
	<?php foreach (array_slice($cata->books, 0 , 5) as $book) {
		$this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book));
	} ?>
</div>
