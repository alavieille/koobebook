<!doctype html>
<html lang="fr">
	<head>
			<meta charset="UTF-8">
			<title><?php echo CHtml::encode($this->pageTitle); ?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/knacss.css" media="all">
			<!-- <link rel="stylesheet" href="css/styles.css" media="all"> -->
	</head>
	<body>
		<header id="header" class="line" role="banner">
			<h1 class="left"><a href="<?php echo Yii::app()->request->baseUrl; ?>">libebook</a></h1>
			<nav id="navigation" class="right" role="navigation">
				<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'catalogues', 'url'=>array('/site/index' )),
					array('label'=>'aide', 'url'=>array('/site/index' )),
					),
				)); ?>

				<?php   
				echo CHtml::beginForm(array('search/search'), 'get', array('style'=> 'inline'));

        		echo CHtml::textField('q', '', array('placeholder'=> 'rechercher...','style'=>'width:140px;'));

        		echo CHtml::submitButton('Go!',array('style'=>'width:30px;'));
        		echo CHtml::endForm('');

        		?>
			</nav>

		</header>

		<div id="main" role="main" class="line">
			<?php echo $content; ?>

		</div>
	</body>
</hmtl>
