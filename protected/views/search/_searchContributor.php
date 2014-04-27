<section>
		<h5 class="w100 mb2 mr3 pl1">
			<a class="icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>$type,'query'=>$query));  ?>"><?php echo ($type != 'editor' && $type != 'illustrator' && $type != 'traductor' ) ?  'Contributeurs' : current($contributors)->translateType().'s' ?> <span class="nbr">(<?php echo count($contributors) ?> résultats)</span></a>
		</h5>
		<div class="autogrid5 catalogue">
			<?php foreach (array_slice($contributors, 0, 10) as $contributor) : ?>
					<?php  $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$contributor->book)); ?>
			<?php endforeach; ?>
		</div>
</section>