$(function(){

	//$(".persoDropDown")
	createDropDown($("select.persoDropDown"));

});

var createDropDown = function(inputSelect) {


	html = '<div class="selectPersonal '+inputSelect.attr('class')+'">\n';
	html += '<p class="selectValue">'+inputSelect.children("option:selected").text();+'</p>\n';
	html += '<ul>\n';
	console.log(inputSelect.children("option"));
	$.each(inputSelect.children("option"),function(key,input){
		html += '<li '+'data-value="'+input.value+'">'+input.text+'</li>\n';
	});
	html += '</ul>\n';
	html += '</div>\n';

	inputSelect.before(html);
	inputSelect.hide();

	$(".selectPersonal ul").hide();

	$(".selectPersonal .selectValue").click(function(event){
		
		event.stopPropagation();
		$(this).next("ul").toggle();

		$("html").click(function(){
			$(".selectPersonal ul").hide();
		});
	});

	$(".selectPersonal ul li").click(function(){
		value = $(this).attr('data-value');
		$(".selectPersonal .selectValue").html($(this).text());
		inputSelect.val(value);
	})


}