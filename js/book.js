/***
* Javascript 
* view Book
****/ 

$(function(){

	$(".detailPrice").hide();
	calcPrice();
	$("#Book_price").keyup(calcPrice);

	/** mange of preview */
	previewPictureDownload();

	if($(".errorSummary:visible").length <= 0 ) {
		$(".etape2").hide();
	}
	else {
		$("#extractInfo").hide();	
	}

	/** mange upload of file */
	manageUpload();

});

var calcPrice = function(){
	var price = $("#Book_price").val();
	if(price > 0) {

		var priceHT = Math.round((price * 0.947)*100)/100;
		var priceEditor = Math.round((priceHT * (70/100))*100)/100;
		var priceSite = Math.round((priceHT * (30/100))*100)/100;
		$(".priceHT").html(priceHT);
		$(".priceEditor").html(priceEditor);
		$(".priceSite").html(priceSite);
		$(".detailPrice").show();
	}

}

var manageUpload = function(){


	var arrayTypeFile = new Array();
	var arrayFile = new Array();
	var numberContributor = $(".contributor").length;

	/** delete in update action **/
	$("#uploadInput ul li .close").click(function(){

		$(this).next().val(1);
		nameClass = $(this).parent().attr('class').split(" ")[0];
		$(this).parent().removeClass().addClass(nameClass);
		$(this).detach();
		return false;
	});

	/** remove click on upload in update action */
	$("#uploadInput ul li:not(.noclick)").live('click',function(){
		var nameClass = $(this).attr('class').split(" ")[0];
		$("#uploadInput input#"+nameClass).click();
		return false;
	});

	/** delete in create action **/
	$("#uploadInput ul li .deleteCreate").live('click',function(){
		console.log('ok');
		var nameClass = $(this).parent().attr('class').split(" ")[0];
		$("#uploadInput input#"+nameClass).val();
		
		delete arrayFile[nameClass];
		delete arrayTypeFile[nameClass];
		$(this).parent().removeClass().addClass(nameClass);
		$(this).parent().children("p").text("");
		$(this).detach();

		return false;
	})

	/*** add book **/
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
		$("#uploadInput ul li."+this.id).append("<a href='' class='deleteCreate'>Supprimer</a>");
		arrayTypeFile[this.id] = file.type;
		arrayFile[this.id] = this.files[0];

	});
	
	/** add contributor **/
	$("#addContributor").click(function()
	{
		numberContributor ++;

		var lastContributor = $(".contributor:last");

		if(lastContributor.find('input[type="text"]').val() != "" ) {
			var newContributor = lastContributor.clone();
			
			newContributor.find('input[type="text"]').attr("name","contributor["+numberContributor+"][name]");
			newContributor.find('input[type="text"]').val("");
			newContributor.find('select').attr("name","contributor["+numberContributor+"][type]");
			$(this).before(newContributor);
			
			lastContributor.find('input[type="text"]').hide();
		
			var contributorText = "<p class='mt0'>"+lastContributor.find('input[type="text"]').val();
			contributorText += " ("+lastContributor.find('.selectPersonal .selectValue').html()+")";
			contributorText += "<span class='pl2 deleteContrib'>x</span>";
			contributorText += "</p>";
		
			lastContributor.find('.selectPersonal').detach();

			lastContributor.append(contributorText);
			
		}
			
		return false;
	});
	

	/** delete contributor **/
	$(".deleteContrib").live('click',function(){
		console.log($(this).parent());
		$(this).parent().parent().detach();
	});

	/** extract metadata of ebook **/
	$("#extractInfo").click(function(){
		$('#uploadInput .personalError').html("");
			console.log(Object.keys(arrayFile).length);
	
		if(Object.keys(arrayFile).length <=0 ){
			$('#uploadInput .personalError').html("Vous devez au moins ajouter un fichier");
			return;
		}	
	
		formdata = new FormData();
		for(key in arrayFile) {
		  formdata.append(key, arrayFile[key]);
		}

		 $.ajax({  
		    url: "extractInfo",  
		    type: "POST",  
		    data: formdata,  
		    processData: false,  
		    contentType: false, 
		    dataType: "json",
		    beforeSend: function() {
		    	progressHtml = '<p id="pourcentProgress">Extraction des données : <span>0% <span></p>';
		    	progressHtml += '<progress id="progressExtract" class="mt2 w50 .small-w100"max="100" value="0" >0%</progress>';
		    	$("#extractInfo").hide();
		    	if($("#progressExtract").length == 0 ) 
		    		$("#uploadInput").append(progressHtml);
		    	else {
		    		$("#pourcentProgress").show();
            		$("#progressExtract").show();
            	}
			
			},
		    xhr: function() {  // custom xhr
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // check if upload property exists
                    myXhr.upload.addEventListener('progress',updateProgress, false); // for handling the progress of the upload
                }
                return myXhr;
            },
		    success:  addExtractMetaInfo,
		    complete : function() {
		    	$("#extractInfo").show();
		    	$('html,body').animate({scrollTop: $(".etape2").offset().top},'slow');
		    	$("#pourcentProgress").hide();
            	$("#progressExtract").hide();
		    }
		}); 

		$(".etape2").show();
		$(this).val("Extraire de nouveau les informations");


	});
var updateProgress = function(evt) {
    if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            $("#pourcentProgress span").html(Math.round(percentComplete * 100) + "%" );
            $("#progressExtract").val(percentComplete * 100 );
            console.log(percentComplete);
    } 
}

	/** add information to form **/
	var addExtractMetaInfo = function(res)
	{
		if(res.title && $("#book-form #Book_title").val() == "" )
			$("#book-form #Book_title").val(res.title);
		if(res.language && $("#book-form #Book_language").val() == "" )
			$("#book-form #Book_language").val(res.language);
		if(res.description && $("#book-form #Book_description").val() == ""  )
			$("#book-form #Book_description").val(res.description);
		if(res.date && $("#book-form #Book_publication").val() == ""  )
			$("#book-form #Book_publication").val(res.date);
		if(res.isbn && $("#book-form #Book_isbn").val() == "" )
			$("#book-form #Book_isbn").val(res.isbn);
		if(res.author && res.author.length > 0) {
			$.each(res.author,function(index,value){$
				$("#book-form .contributor input").val(value);
				$("#addContributor").click();
			});
		}
	}

	/** check number of upload file **/
	var checkNumberFile = function (typeFile,id){
		
		for (var input in arrayTypeFile){
			if(input != id && arrayTypeFile[input] == typeFile)
				return false;
		}
		return true;
	}

	/** check type of file **/
	var checkTypeFile = function(type){
		arrayType = ["application/epub+zip","application/x-mobipocket-ebook","application/pdf"];
		return ($.inArray(type,arrayType) >= 0 );
	}
}


/** preview cover of ebook **/
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