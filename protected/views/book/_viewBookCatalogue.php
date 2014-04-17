<?php 
/**
* Design of one book Catalogue
**/
?>
<div class="book mb0">
	<a class="" href="<?php echo Yii::app()->createUrl('book/view/',array( 'id'=>$book->id)); ?> " >
	<?php 
		 $picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
		 if(! is_null($book->picture)){
		 	$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
		 	$picture = $urlUpload.DIRECTORY_SEPARATOR."book/".$book->id."/".$book->id."-".$book->picture;
		}
	?>
		<figure class="txtcenter  mt0 ">
			<img class="" src="<?php echo $picture; ?>" alt="couverture" />
			<figcaption>
				<p class="pt1 w100 txtcenter"><?php echo $book->title;?></p>		
			</figcaption>
		</figure>
	</a>	
</div>