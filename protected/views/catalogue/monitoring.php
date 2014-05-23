<?php
/* @var $this CatalogueController */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/personalSelect.js',CClientScript::POS_END);
$this->pageTitle=Yii::app()->name . ' - Tableau de bord';

?>
<script>
	$(function(){
		$("#month").focus(function () {
			$(".ui-datepicker-calendar").hide();
			$("#ui-datepicker-div").position({
			my: "center top",
			at: "center bottom",
			of: $(this)
			});
		});
	});
</script>
<section id="monitoring">
	<h2 class="pt2 mb1">Tableau de bord</h2>
	<h3 class="">Filtrer</h3>
	<div class="form">
		<form class="mb3 " action="<?php echo $this->createUrl('/catalogue/monitoring'); ?>" method='GET'>
			<div class="rowInput inbl mr2">
			<label class="pb1" for="month">Mois :</label>
			<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'value' => $month,
					    'name' => "month",
					    'attribute' => 'publication',
					    'language' => 'fr',
					    'options' => array(
							'dateFormat'=>'yy-mm',
							'changeMonth'=> 'true',
							'changeYear'=> 'true',
							'showButtonPanel' => 'true',
							'onClose' => new CJavaScriptExpression('function(dateText, inst) {
								var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
								var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
								$(this).val($.datepicker.formatDate("yy-mm", new Date(year, month, 1)));
								}'),
					    	)
					));

					?>
				</div>
				<div class="rowInput inbl">
				  <label class="pb1" for="type">Type livre :</label>
					<?php echo CHtml::dropDownList('type', $type ,array('buy'=>'Payant','free'=>'Gratuit'),array("class"=>"persoDropDown w200p mr2 ")); ?>
				</div>
				<div class=" pt1 rowInput buttons inbl pr2">
					<?php echo CHtml::submitButton('Filtrer'); ?>
				</div>
		</form>
	</div>
	<table class="striped  data table" summary="">
		<thead>
			<tr>
				<th scope="col" class="txtcenter">Titre</th>
				<th scope="col" class="txtcenter">Prix</th>
				<?php if($type == 'buy') : ?>
				<th scope="col" class="txtcenter">Votre pourcentage <br>(70% du prix HT)</th>
				<?php endif; ?>
				<th scope="col" class="txtcenter">Téléchargement</th>
			</tr>

		</thead>
	
		<tbody>
			<tr>
				<td class="txtcenter ">Total</td>
				<td class="txtcenter" ><?php echo $totalPrice ?> &euro;</td>
				<?php if($type == 'buy') : ?>
				<td class="txtcenter" ><?php echo $totalEditor ?> &euro;</td>
				<?php endif; ?>
				<td class="txtcenter"><?php echo $totalDownload ?></td>
			</tr>
			<?php foreach ($monitoring as $book) : ?>
			<tr>
				<td><?php echo $book->title ?></td>
				<td class="txtcenter" ><?php echo $book->price ?> &euro;</td>
				<?php if($type == 'buy') : ?>
					<td class="txtcenter"><?php echo round(($book->price * 0.947)*(70/100),2) ?> &euro;</td>
					<td class="txtcenter"><?php echo $book->paymentCount($month) ?></td>
				<?php else : ?>
					<td class="txtcenter"><?php echo $book->libraryCount($month) ?></td>
				<?php endif; ?>
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

</section>