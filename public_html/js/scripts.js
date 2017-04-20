
$("#more-king-grass").bind("click", function(){
    // hide more...
    $(".more-text").hide();
    //show text
    $(".full-text").show(200);
    $(".less-text").show(200);
});


$("#more-viaspace").bind("click", function(){
    // hide more...
    $(".more-text").hide();
    //show text
    $(".full-text").show(200)
    $(".less-text").show(200);
});

$("#more-labs").bind("click", function(){
    // hide more...
    $(".more-text").hide(200);
    //show text
    $(".full-text").show(200)
    $(".less-text").show(200);
});



$("#show-less-king-grass").bind("click", function(){
    // hide more...
    $(".less-text").hide(200);
    //show text
    $(".more-text").show(200);
    $(".full-text").hide(200);
});

$("#show-less-viaspace").bind("click", function(){
    // hide more...
    $(".less-text").hide(200);
    //show text
    $(".more-text").show(200);
    $(".full-text").hide(200);
});

$("#show-less-labs").bind("click", function(){
    // hide more...
    $(".less-text").hide(200);
    //show text
    $(".more-text").show(200);
    $(".full-text").hide(200);
});


$(".videopopuplauncher").on("click", function(){
    var vidtoview = $(this).attr("data");
//    alert(vidtoview);
    $("#"+vidtoview).parent().dialog({
        height:300,
        width:355,
        title: "Watch Video",
        create: function(ev) {
            $(".ui-dialog-content").find(".video-container").css("width","340px");
        }
    });
});


/**** In case I need to scroll
 * //Finds y value of given object
function findPos(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	return [curtop];
	}
}
//Get object
var SupportDiv = document.getElementById('customer_info');
 
//Scroll to location of SupportDiv on load
window.scroll(0,findPos(SupportDiv));
 * 
 * **/




