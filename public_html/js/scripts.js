
$("#more-king-grass").bind("click", function(){
    // hide more...
    $(this).hide();
    //show text
    $("#less-king-grass").show(200);
});


$("#more-viaspace").bind("click", function(){
    // hide more...
    $(this).hide();
    //show text
    $("#less-viaspace").show(200);
});

$("#more-labs").bind("click", function(){
    // hide more...
    $(this).hide();
    //show text
    $("#less-labs").show(200);
});



$("#show-less-king-grass").bind("click", function(){
    // hide more...
    $("#less-king-grass").hide(200);
    //show text
    $("#more-king-grass").show(200);
});

$("#show-less-viaspace").bind("click", function(){
    // hide more...
    $("#less-viaspace").hide(200);
    //show text
    $("#more-viaspace").show(200);
});

$("#show-less-labs").bind("click", function(){
    // hide more...
    $("#less-labs").hide(200);
    //show text
    $("#more-labs").show(200);
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




