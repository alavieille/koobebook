<?php header("Content-type: text/xml"); ?>
<?xml version="1.0" encoding="UTF-8"?>
<entry xmlns="http://www.w3.org/2005/Atom" xmlns:thr="http://purl.org/syndication/thread/1.0"    xmlns:dc="http://purl.org/dc/terms/" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:dcterms="http://purl.org/dc/terms/">
<title><?php echo $model->title ?></title>
<id><?php echo $model->id; ?></id>

<?php foreach ($author as $value) : ?>
	<author>
  		<name><?php echo $value["name"]; ?></name>
	</author>
<?php endforeach; ?>

<?php foreach ($traductor as $value) : ?>
		<contributor>
	  		<name><?php echo $value["name"]; ?></name>
		</contributor>
<?php endforeach; ?>

<?php foreach ($illustrator as $value) : ?>
		<contributor>
	  		<name><?php echo $value["name"]; ?></name>
		</contributor>
<?php endforeach; ?>

<published><?php echo str_replace('+00:00', 'Z', gmdate('c',strtotime($model->publication))) ?></published>
<updated><?php echo str_replace('+00:00', 'Z', gmdate('c')) ?></updated>

<?php if(! empty($model->language)) :?>
<dcterms:language><?php echo $model->language; ?></dcterms:language>
<?php endif; ?>

<?php if(! empty($model->isbn)) :?>
<dc:identifier xsi:type="dcterms:URI">urn:ISBN:<?php echo $model->isbn; ?></dc:identifier>
<?php endif; ?>



<?php if(isset($model->catalogueId)) : ?>
<dcterms:publisher><?php echo $model->catalogue->name ?></dcterms:publisher>
<dcterms:issued><?php  echo $model->publication ?></dcterms:issued>
<?php endif; ?>

<summary>
	<?php  echo CHtml::encode($model->getExcerptDescription(100)); ?>
</summary>

<link type="text/html" href="http://192.168.43.137/www-dev/libebook/index.php/book/95" rel="alternate" title="Voir sur Feedbooks"/>


<?php if(! is_null($model->picture)) : ?>
<?php  
 			$urlUpload = Yii::app()->getBaseUrl(true).DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR."book/".$model->id."/".$model->id."-".$model->picture;
?>
<link type="image/jpeg" href="<?php echo $picture; ?>" rel="http://opds-spec.org/image"/>
<link type="image/jpeg" href="<?php echo $picture; ?>" rel="http://opds-spec.org/image/thumbnail"/>
<?php endif; ?>


<?php if(isset($model->epub)) : ?>
<link type="application/epub+zip" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$model->id,'format'=>'epub')); ?>" rel="http://opds-spec.org/acquisition/open-access"/>
<?php endif; ?>

<?php if(isset($model->mobi)) : ?>
<link type="application/x-mobipocket-ebook" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$model->id,'format'=>'mobi')); ?>" rel="http://opds-spec.org/acquisition/open-access"/>
<?php endif; ?>

<?php if(isset($model->pdf)) : ?>
<link type="application/pdf" href="<?php echo yii::app()->createAbsoluteUrl('book/download',array('id'=>$model->id,'format'=>'pdf')); ?>" rel="http://opds-spec.org/acquisition/open-access"/>
<?php endif; ?>

<?php if(isset($model->catalogueId)) : ?>
<link type="application/atom+xml;profile=opds-catalog;kind=acquisition" href="<?php echo yii::app()->createAbsoluteUrl('catalogue/viewodps',array('id'=>$model->catalogueId));  ?>" rel="related" title="Du m&#234;me &#233;diteur"/>
<?php endif;?>

<content type="html"><?php echo CHtml::encode($model->description); ?></content>

</entry>