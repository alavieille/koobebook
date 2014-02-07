/***
* Javascript 
* Pour vue Book
****/ 

$(function(){
	previewPictureDownload();
});


var previewPictureDownload = function(){


	var buttonUpdate = $('[data-previewDownload="button"');
	var buttonDelete = $('[data-previewDownload="delete"');
	var inputFile = $('[data-previewDownload="input"');
	var preview = $('[data-previewDownload="preview"');
	var error = $('[data-previewDownload="error"')
 	
 	var saveDefaultCover = preview.attr("src");

 	inputFile.addClass("visually-hidden");
 	buttonUpdate.removeClass("visually-hidden");
 	preview.removeClass("visually-hidden");

 	// relie le bouton delete au input file
	buttonDelete.click(function(){
		preview.attr("src",saveDefaultCover);
		inputFile.val("");
		buttonDelete.addClass("visually-hidden");


	});

 	// relie le bouton update au input file
	buttonUpdate.click(function(){
		error.hide();
		$((inputFile).get()).click();
	});
	
	inputFile.change(function(){
		var file = this.files[0];
		if( ! isPicture(file)){
			error.html("Les extensions de fichier autorisées sont : jpg, gif, png.");
			error.show();
			inputFile.addClass("error");
			return;
		}
		var reader = new FileReader();
		reader.onload=function(){
			preview.attr("src",this.result);
			buttonDelete.removeClass("visually-hidden");
		}
		reader.readAsDataURL(file);
	})

	var isPicture = function(file){ // test si le fichier est une image 
		var type = new Array('image/pjpeg','image/jpeg','image/bmp','image/png','image/gif','image/x-png');
	return ($.inArray(file.type,type)!=-1);
	}


}