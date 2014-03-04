<div class="book mb2">
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