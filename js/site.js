/***
* Javascript 
* vue principale site
****/ 
$(function(){
	
	// menu principale 
	$("#showMenu").click(showMenu);
	if($(window).width() < 768)
		$("#siteNav ul").hide();

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
