//needs get_object_by_id.js to work

function phone_validate(textbox_str){


	var error_msg 	= "";
	var digit		= "";
	var area_code 	="";
	var phone_1 	= "";
	var phone_2 	= "";
	
	var text_obj = getObject(textbox_str);
	var phone = text_obj.value
	//remove all none numbers
	phone= phone.replace(/\D/g, '');
	
	if(phone.length > 0){
		//verify that the phone number is 10  digets long
		if(phone.length < 10){
			if ((10 - phone.length) > 1){
				digit = "s";
			}
			error_msg = "You are " + (10 - phone.length ) + " Digit"+ digit +" shy of a valid phone number.";
		}
		if(phone.length > 10){
			if ((phone.length - 10) > 1){
				digit = "s";
			}
			error_msg = "You have " + (phone.length - 10 ) + " Digit"+ digit +" too many to be a valid phone number.";
		}
		
		//build phone number format
		area_code = phone.substring(0,3);
		phone_1 = phone.substring(3,6);
		phone_2 = phone.substring(6,10);
		phone= "(" + area_code + ") " + phone_1 +" - "+ phone_2;
		
		if (error_msg.length > 0){
			alert(error_msg);
		}
	}
	text_obj.value = phone;
}
