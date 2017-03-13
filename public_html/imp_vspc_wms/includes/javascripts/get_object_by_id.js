function getObject(obj) {
  	var theObj;
  	if(document.all) {
    	if(typeof obj=="string") {
      		return document.all(obj);
    	} else {
      		return obj.style;
    	}
  	}
  	if(document.getElementById) {
    	if(typeof obj=="string") {
      		return document.getElementById(obj);
    	} else {
      		return obj.style;
    	}
  	}
  	return null;
}