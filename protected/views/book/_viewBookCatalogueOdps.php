<entry>
<title><?php echo $book->title; ?></title>
<subtitle><?php echo $book->subtitle ?></subtitle>
<id><?php echo $book->id ?></id>
<author>
  <name><?php echo $book->author; ?></name>
</author>
<published><?php echo str_replace('+00:00', 'Z', gmdate('c',strtotime($book->publication))) ?></published>
<updated><?php echo str_replace('+00:00', 'Z', gmdate('c')) ?></updated>
<dcterms:publisher><?php echo $book->catalogue->name ?></dcterms:publisher>
<summary>
<?php echo $book->getExcerptDescription(100); ?>
</summary>

<?php if(! is_null($book->picture)) : ?>
<?php  
 			$urlUpload = Yii::app()->getBaseUrl(true).DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR."book/".$book->id."/".$book->id."-".$book->picture;
?>
<link type="image/jpeg" href="<?php echo $picture; ?>" rel="http://opds-spec.org/image"/>
<link type="image/jpeg" href="<?php echo $picture; ?>" rel="http://opds-spec.org/image/thumbnail"/>
<?php endif; ?>

<?php if(isset($book->epub)) : ?>
<link type="application/epub+zip" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$book->id,'format'=>'epub')); ?>" rel="http://opds-spec.org/acquisition/sample"/>
<?php endif; ?>

<?php if(isset($book->mobi)) : ?>
<link type="application/x-mobipocket-ebook" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$book->id,'format'=>'mobi')); ?>" rel="http://opds-spec.org/acquisition/sample"/>
<?php endif; ?>

<?php if(isset($book->pdf)) : ?>
<link type="application/pdf" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$book->id,'format'=>'pdf')); ?>" rel="http://opds-spec.org/acquisition/sample"/>
<?php endif; ?>

<link type="application/atom+xml;type=entry;profile=opds-catalog" href="<?php echo yii::app()->createAbsoluteUrl('book/viewodps',array('id'=>$book->id));  ?>" rel="alternate" title="Entr&#233;e compl&#232;te"/>
</entry>