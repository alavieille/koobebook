/***
* Javascript 
* view Book
****/ 

$(function(){
	previewPictureDownload();
});


var previewPictureDownload = function(){


	var buttonUpdate = $('[data-previewDownload="button"]');
	var buttonDelete = $('[data-previewDownload="delete"]');
	var inputFile = $('[data-previewDownload="input"]');
	var preview = $('[data-previewDownload="preview"]');
	var error = $('[data-previewDownload="error"]')
 	
 	var saveDefaultCover = preview.attr("src");

 	inputFile.addClass("visually-hidden");
 	buttonUpdate.removeClass("visually-hidden");
 	preview.removeClass("visually-hidden");

 	// button delete
	buttonDelete.click(function(){
		preview.attr("src",saveDefaultCover);
		inputFile.val("");
		buttonDelete.addClass("visually-hidden");
		return false;


	});

 	// button update 
	buttonUpdate.click(function(){
		error.hide();
		$((inputFile).get()).click();
		return false;
	});
	
	preview.click(function(){
		error.hide();
		$((inputFile).get()).click();
		return false;
	});
	
	inputFile.change(function(){
		var file = this.files[0];
		if( ! isPicture(file)){
			error.html("Les extensions de fichier autorisées sont : jpg, gif, png.");
			error.show();
			inputFile.addClass("error");
			return false;
		}
		var reader = new FileReader();
		reader.onload=function(){
			preview.attr("src",this.result);
			buttonDelete.removeClass("visually-hidden");
		}
		reader.readAsDataURL(file);
	})

	var isPicture = function(file){ // check if file is picture
		var type = new Array('image/pjpeg','image/jpeg','image/bmp','image/png','image/gif','image/x-png');
	return ($.inArray(file.type,type)!=-1);
	}


}