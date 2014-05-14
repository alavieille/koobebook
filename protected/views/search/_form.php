<form id="formSearch" class="mb2" method='get' action="<?php echo $this->createUrl('search/search')  ?>">
	<div class="form w80 center line">
		<?php echo CHtml::dropDownList('type',$select,array('all'=>'Tous','book'=>'Livres','editor'=>'Éditeurs','author'=>'Auteurs','illustrator'=>'Illustrateurs','traductor'=>'Traducteurs'),array("class"=>"inbl w150p  persoDropDown")); ?>
				
		<input type="search"  placeholder="Auteurs, Éditeurs, Livre, ..." name="query" value="<?php echo $query; ?>" />
		<input type="image" class="inbl  small-hidden" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/searchForm.png"  value="rechercher" />
	</div>
</form>