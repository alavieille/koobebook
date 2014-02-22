/***
* Javascript 
* view Catalogue
****/ 
$(function(){

$(".btParam").click(showParam);
$(".param").hide();
});

$('html').click(function() {
	$(".param").hide();
	$(".btParam").removeClass("btParamActive");
});

var showParam = function(event){
	$(".param").not($(this).next(".param")).hide();
	console.log($(this).next(".param"));
	$(this).toggleClass("btParamActive");
	$(this).next(".param").slideToggle();
	event.stopPropagation();
}