			<section>
				<h5 class="w100 mb2 mr3 pl1">
					<a class="icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>$type,'query'=>$query));  ?>">Éditeurs <span class="nbr">(<?php echo count($catalogues) ?> résultats)</span></a>
				</h5>
			<?php foreach ( array_slice($catalogues, 0, 2) as $cata) : ?>
				<?php  $this->renderPartial('//catalogue/_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
			</section>