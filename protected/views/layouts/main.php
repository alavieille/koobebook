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
			<nav id="navigation" role="navigation">
				<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index'))
					),
				)); ?>
			</nav>
		</header>
		<div id="main" role="main" class="line">
			<?php echo $content; ?>

		</div>
	</body>
</hmtl>
