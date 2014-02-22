/***
* Javascript 
* view principale site
****/ 
$(function(){
	
	// main navigation 
	$("#showMenu").click(showMenu);
	if($(window).width() < 768)
		$("#siteNav ul").hide();


	// private navigation
	if($(window).width() < 768)
		$("#privateNav").hide();
	$("#privateMenu").click(showPrivateMenu);
});

var showMenu = function(){
	$("#siteNav ul").slideToggle();
}


var showPrivateMenu = function(){
	$("#privateNav").slideToggle();
}
