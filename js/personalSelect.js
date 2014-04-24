$(function(){

	//$(".persoDropDown")
	createDropDown($("select.persoDropDown"));

});

var createDropDown = function(inputSelect) {


	html = '<div class="selectPersonal '+inputSelect.attr('class')+'">\n';
	html += '<p class="selectValue">'+inputSelect.children("option:selected").text();+'</p>\n';
	html += '<ul>\n';
	$.each(inputSelect.children("option"),function(key,input){
		html += '<li '+'data-value="'+input.value+'">'+input.text+'</li>\n';
	});
	html += '</ul>\n';
	html += '</div>\n';

	var persoDropDown = $(html);
	inputSelect.before(persoDropDown);
	console.log(inputSelect);
	inputSelect.hide();

	persoDropDown.children("ul").hide();

	$(".selectPersonal .selectValue").live('click',function(event){

		event.stopPropagation();
		$(this).next("ul").toggle();
		$("html").click(function(){
			$(".selectPersonal ul").hide();
		});
	});



	$(".selectPersonal ul li").live('click',function(){
		value = $(this).attr('data-value');
		$(".selectPersonal .selectValue").html($(this).text());
		$(this).parents(".selectPersonal").next().val(value);

	})


}