<div class="mb2 book" draggable="true" data-id="<?php echo $book->id ?>">
	<p class="pa0 ma0 right mr1 pt1 btParam">paramètres</p>
	<div class="param pa1">
		<nav>
			<ul>
				<li><a href="<?php echo Yii::app()->createUrl('book/update/',array( 'id'=>$book->id)); ?>">Modifier</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('book/delete/',array( 'id'=>$book->id)); ?>">Supprimer</a></li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('book/togglePush/',array( 'id'=>$book->id)); ?>">
					<?php echo (! $book->push) ? "Mettre en avant" : "Supprimer de la mise en avant" ?>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<a class="line" href="<?php echo Yii::app()->createUrl('book/view/',array( 'id'=>$book->id)); ?> " >
	<?php 
		 $picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
		 if(! is_null($book->picture)){
		 	$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
		 	$picture = $urlUpload.DIRECTORY_SEPARATOR.$book->id."-".$book->picture;
		}
	?>
		<figure class="txtcenter  mt0 line">
			<img class="" src="<?php echo $picture; ?>" alt="couverture" />
			<figcaption>
				<p class="pt1 w100 txtcenter"><?php echo $book->title;?></p>		
			</figcaption>
		</figure>
	</a>
</div>