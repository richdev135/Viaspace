
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


//debugger;

var isIE = detectIE();
//alert(isIE);
/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
  var ua = window.navigator.userAgent;

  // Test values; Uncomment to check result …

  // IE 10
  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
  
  // IE 11
  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
  
  // Edge 12 (Spartan)
  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';
  
  // Edge 13
  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}

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




