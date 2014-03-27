<?php header("Content-type: text/xml"); ?>
<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns:dcterms="http://purl.org/dc/terms/" xmlns:opds="http://opds-spec.org/2010/catalog" xml:lang="fr"  xmlns="http://www.w3.org/2005/Atom">
  <id><?php echo $model->id; ?></id>
  <title><?php echo $model->name; ?></title>
  <updated><?php echo str_replace('+00:00', 'Z', gmdate('c')) ?></updated>
  <icon><?php echo Yii::app()->getBaseUrl(true)."/images/logo.png"; ?></icon>
  <author>
    <name><?php echo $model->name; ?></name>
    <uri><?php echo yii::app()->createAbsoluteUrl("catalogue/view",array("id"=>$model->id)); ?></uri>
  </author>


<link type="application/atom+xml;profile=opds-catalog;kind=navigation" 
href="<?php echo yii::app()->createAbsoluteUrl("catalogue/viewodps",array("id"=>$model->id)); ?>" rel="start" title="Accueil"/>

<link type="application/atom+xml; profile=opds-catalog; kind=acquisition" href="<?php echo yii::app()->createAbsoluteUrl("catalogue/viewodps",array("id"=>$model->id)); ?>" rel="self" title="Tous ces ebook"/>


<link type="application/atom+xml;profile=opds-catalog;kind=acquisition" href="<?php echo yii::app()->createAbsoluteUrl("catalogue/viewodps",array("id"=>$model->id,"all"=>0)); ?>" rel="http://opds-spec.org/sort/popular" title="A la une"/>

<?php foreach ($books as $book) : ?>
		<?php $this->renderPartial('//book/_viewBookCatalogueOdps', array('book'=>$book)); ?>
<?php endforeach; ?>

</feed>
