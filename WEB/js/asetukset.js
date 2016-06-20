  $(function() {


/*
jQuery.hrefClick = function hrefClick(){
    $("a").click(function (event) {
        event.preventDefault();
        window.location = $(this).attr("href");
    });
}
jQuery.hrefClick();
*/



$(document).delegate(".logoutPainike","click",function(){
	window.localStorage.setItem( "logoutPainike", 'OK');
});


$("#reload").click(function(){
   	window.location.reload();
});

$("#logout").click(function(){
	parent.postMessage("logout", "*");
});


    $( ".datepicker" ).datepicker({
	dateFormat: 'dd.mm.yy',
	changeMonth: true, yearRange : 'c-65:c+10',
	changeYear: true,

     beforeShow: function (input, inst) {
         var offset = $(input).offset();
         var height = $(input).height();
         window.setTimeout(function () {
             inst.dpDiv.css({ top: (offset.top + height + 4) + 'px', left: offset.left + 'px' })
         }, 1);
     }

    });

    $( ".windowsdatepicker" ).datepicker({
	dateFormat: 'yy-mm-dd',
    });





  });



