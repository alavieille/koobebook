/***
* Javascript 
* view Catalogue
****/ 
$(function(){

$(".btParam").click(showParam); // show parameter
$(".param").hide();

$('html').click(function() { 
	$(".param").hide();
	$(".btParam").removeClass("btParamActive");
});

$("#ltBook .book, #pushBook .book ").each(function(index,element){
	dndHandler.applyDragEvents($(element));
	console.log(element);

});

dndHandler.applyDropEvents($("#pushBook")); 
dndHandler.applyDropOutEvents($("#ltBook")); 



});

var dropBook = function(e){
	e.preventDefault();
	e.stopPropagation();
	console.log(e);
	console.log($(this));
}

var showParam = function(event){
	$(".param").not($(this).next(".param")).hide();
	console.log($(this).next(".param"));
	$(this).toggleClass("btParamActive");
	$(this).next(".param").slideToggle();
	event.stopPropagation();
}

var dndHandler = {
     
    draggedElement: null,
    parentDraggedElement: null,
    
    applyDragEvents: function(element) {

    	//console.log(element);
		var dndHandler = this;
        
        element.bind('dragstart', function(e) {

        	target = e.target;
        	while(target.className.indexOf('book') == -1) { 
	                target = target.parentNode;
	        }
	        dndHandler.parentDraggedElement = $(target).parent();
            dndHandler.draggedElement = $(target); 
            e.originalEvent.dataTransfer.setData('text/plain', ''); 
        });
            
    },
	 applyDropOutEvents: function(dropper) {
	        dropper.bind('dragover', function(e) {
	        	if (dndHandler.parentDraggedElement.hasClass("dropper")){
	            	e.preventDefault();
	            	$(this).addClass("onDrop");
	        	}

	    	}); 

		    dropper.bind('dragleave', function() {
		        $(this).removeClass("onDrop");
		    });
		    var dndHandler = this; 
		    dropper.bind('drop', function(e) {	
		        
		  		if (dndHandler.parentDraggedElement.hasClass("dropper")){
			        draggedElement = dndHandler.draggedElement; 
			   

			
			        if($("#pushBook .dropper .book").length > 0) {
			       		$("#pushBook #dropInfo").hide();
			        }
			        else {
			        	$("#pushBook #dropInfo").show();
			        }

			        $.get( yii.urls.base+"/index.php/book/togglePush/"+draggedElement.attr("data-id"));
			        draggedElement.detach().appendTo($("#ltBook>div"));
			        draggedElement.find(".param li a").eq(2).html("Mettre en avant");

			        if($("#pushBook .dropper .book").length > 0) {
			       		$("#pushBook #dropInfo").hide();
			        }
			        else {
			        	$("#pushBook #dropInfo").show();
	        		}

			        $("#ltBook").removeClass("onDrop");
			    }     
		    });            
	},
 
    applyDropEvents: function(dropper) {
        dropper.bind('dragover', function(e) {
            e.preventDefault();
            $(this).addClass("onDrop");
    	}); 
	    dropper.bind('dragleave', function() {
	    	$(this).removeClass("onDrop");
	    });
	    var dndHandler = this; 
	    dropper.bind('drop', function(e) {	
	        
	        draggedElement = dndHandler.draggedElement; 
	      	var target = e.target;
	  
	        while(target.id.indexOf('pushBook') == -1) { 
	                target = target.parentNode;
	        }
	        
  			$.get( yii.urls.base+"/index.php/book/togglePush/"+draggedElement.attr("data-id"));
	        draggedElement.detach().appendTo($("#pushBook .dropper"));
	    	draggedElement.find(".param li a").eq(2).html("Supprimer de la mise en avant");

	    	console.log($("#pushBook .dropper .book").length);
	        if($("#pushBook .dropper .book").length > 0) {
	       		$("#pushBook #dropInfo").hide();
	        }
	        else {
	        	$("#pushBook #dropInfo").show();
	        }

	        $(target).removeClass("onDrop");
		

	    });          	  
	}


};