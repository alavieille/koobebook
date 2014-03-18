/***
* Javascript 
* view Book
****/ 

$(function(){
	/** mange of preview */
	previewPictureDownload();

	/** mange upload of file */
	manageUpload();

});

var manageUpload = function(){


	var arrayTypeFile = [];


	$("#uploadInput ul li .close").click(function(){

		$(this).next().val(1);
		nameClass = $(this).parent().attr('class').split(" ")[0];
		$(this).parent().removeClass().addClass(nameClass);
		$(this).detach();
		return false;
	});

	$("#uploadInput ul li:not(.noclick)").live('click',function(){
		var nameClass = $(this).attr('class').split(" ")[0];
		$("#uploadInput input#"+nameClass).click();
		return false;
	});


	$("#uploadInput input[type='file']").change(function(ev){

		file = this.files[0];
		$('#uploadInput .personalError').html("");

		if( ! checkTypeFile(file.type)) {
			$('#uploadInput .personalError').html("Seul les fichiers epub, mobi et pdf sont autorisés");
			return;
		}

		if(!checkNumberFile(file.type,this.id)){

			$('#uploadInput .personalError').html("Vous ne pouvez envoyer seulement un seul fichier par format");
			return;
		}


		name = file.name.substr(0,7)+"..."+file.name.substr(-7,7);
		$("#uploadInput ul li."+this.id).children("p").html(name);
		$("#uploadInput ul li."+this.id).removeClass("epub mobi pdf");
		switch(file.type)
		{
		case "application/epub+zip":
		  	$("#uploadInput ul li."+this.id).addClass("epub");
		  break;
		case "application/x-mobipocket-ebook":
		 	$("#uploadInput ul li."+this.id).addClass("mobi");
		  break;
		case "application/pdf":
		 	$("#uploadInput ul li."+this.id).addClass("pdf");
		  break;
		}
		arrayTypeFile[this.id] = file.type;
	});

	var checkNumberFile = function (typeFile,id){
		
		for (var input in arrayTypeFile){
			if(input != id && arrayTypeFile[input] == typeFile)
				return false;
		}
		return true;
	}

	var checkTypeFile = function(type){
		arrayType = ["application/epub+zip","application/x-mobipocket-ebook","application/pdf"];
		return ($.inArray(type,arrayType) >= 0 );
	}
}

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