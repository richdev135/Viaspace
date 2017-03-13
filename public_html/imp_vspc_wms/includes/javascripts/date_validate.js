//needs get_object_by_id.js to work

function fill_date(textbox_str){
	var text_obj = getObject(textbox_str);
	var date_str = text_obj.value;
	
	if(date_str == ""){
		var thedate = new Date( );
		
		var theMonth = thedate.getMonth()
		//if (theMonth < 10) {
		//	theMonth = "0"+theMonth;
		//}
		
		date_str = theMonth + "/" + thedate.getDate() + "/" + thedate.getYear();
	}
	//alert(date_str);
	if (!(date_str == text_obj.value)){
		text_obj.value = date_str;
	}
	//date_validation(textbox_str);
}
function date_validation2(textbox_str){
	var text_obj = getObject(textbox_str);
	var date_str = text_obj.value;
	
	//turn alterant delimiters into a "/"
	date_str = date_str.replace(/(\-|\||\\)/g, '/');
	
	//remove any non number or non "/" into a "/"
	date_str = date_str.replace(/[^0-9\/]/g, '');
	
	//prevent "/" from beign first char
	date_str = date_str.replace(/^\//g, '');
	//prevent muliple "/" next to each other
	date_str = date_str.replace(/\/+/g, '/');
	
	
	
	
	
	
	if (!(date_str == text_obj.value)){
		text_obj.value = date_str;
	}
}
	
function date_validation3(textbox_str){
	var text_obj = getObject(textbox_str);
	var date_str = text_obj.value;
	var valid_str
	var mon
	var mon_pos
	var day
	var day_pos
	var year
	var year_pos
	
	valid_str = "";
	mon_pos  = 0;
	day_pos  = 2;
	year_pos = 4;
	
		
	if(date_str.length < 2 ){	
		//remove all non numbers
		date_str = date_str.replace(/[^0-9]/g, '');
	}else{
		date_str = date_str.replace(/[^0-9]/g, '');
	}
		
	if(date_str.length > 1 ){
			
		//month
		mon = date_str.substring(mon_pos,mon_pos+2);
		//if month is greater the 12, invalid, only use fist digit
		if(mon > 12){
			mon = mon.substring(0,1)	
		}
		//if month is only 1 digit in length, append with precedding zero 
		if(mon.length == 1){
			mon = "0" + mon;
			day_pos  = day_pos  -1;
			year_pos = year_pos -1;
		}
		//alert(mon);
		
		//day
		day = date_str.substring(day_pos,day_pos+2);
		//if day is greater the 31, invalid, only use fist digit
		if(day > 31){
			day = day.substring(0,1)
		}
		//if day is only 1 digit in length, append with precedding zero 
		if(day.length == 1 && date_str.length > day_pos+1){
			day = "0" + day;
			year_pos = year_pos - 1;
		}
		//alert(day);
		
		//year
		//alert(year_pos);
		year = date_str.substring(year_pos, date_str.length+1);
		//alert(year);
		
		date_str = mon + day + year
		//alert(mon + "/"+ day + "/"+ year);
		
		//position second slash
		if(date_str.length > 4 ){
			date_str= date_str.substring(0,4) + "/" + date_str.substring(4,date_str.length).replace(/[^0-9]/g, '');
		}
		
		//position first slash	
		if(date_str.length > 2 ){
			//alert(date_str.substring(2,3) );
			date_str= date_str.substring(0,2).replace(/[^0-9]/g, '') + "/" + date_str.substring(2,date_str.length);
		}	
		
	}
	//position first slash	
	//if(date_str.length > 2  && !(date_str.substring(2,3) == "/") ){
		//alert(date_str.substring(2,3) );
	//	date_str= date_str.substring(0,2).replace(/[^0-9]/g, '') + "/" + date_str.substring(2,date_str.length);
	//}
	
	//position second slash
	//if(date_str.length > 5  && !(date_str.substring(5,6) == "/")){
	//	date_str= date_str.substring(0,5) + "/" + date_str.substring(5,date_str.length).replace(/[^0-9]/g, '');
	//}

	//prevent length > 10
	if(date_str.length >10){
		date_str= date_str.substring(0,10);
	}
	
	if (!(date_str == text_obj.value)){
		text_obj.value = date_str;
	}
}


function date_validation(textbox_str){

	var text_obj = getObject(textbox_str);
	if (!text_obj.value == ""){
		//var text_obj = document.getElementById(textbox_str);
		//remove dashes
		text_obj.value= text_obj.value.replace(/\-+/g, '/');
		text_obj.value= text_obj.value.replace(/[^0-9\/]/g, '');
		//validate month
		text_obj.value= text_obj.value.replace(/^([0-9])\//g, '0$1/');
		//validate day
		text_obj.value= text_obj.value.replace(/\/([0-9])\//g, '/0$1/');
		//validate year
		text_obj.value= text_obj.value.replace(/\/([0-9])$/g, '/200$1');
		text_obj.value= text_obj.value.replace(/\/([5-9][0-9])$/g, '/19$1');
		text_obj.value= text_obj.value.replace(/\/([0-4][0-9])$/g, '/20$1');
		text_obj.value= text_obj.value.replace(/\/([0-9]{3})$/g, '/1$1');
		
		//text_obj.value= text_obj.value.replace(/\/([0-9])$/g, '/200$1');
		//text_obj.value= text_obj.value.replace(/\/([0-9]{2})$/g, '/20$1');
		//text_obj.value= text_obj.value.replace(/\/([0-9]{3})$/g, '/2$1');
		
		
		
		// 09/30/1981 01/34/6789
		//month
		if(text_obj.value.substring(0,2) >12){
			text_obj.value="12" + text_obj.value.substring(2,10);
		}
		//day
		if(text_obj.value.substring(3,5) > 31){
			text_obj.value= text_obj.value.substring(0,3) + "31" + text_obj.value.substring(5,10);
		}
		//year
		var thedate = new Date( );
		var year = thedate.getFullYear( );
		if((text_obj.value.substring(6,10) > (year+10)) | (text_obj.value.substring(6,10) < (year -130))){
			text_obj.value= text_obj.value.substring(0,6) +year; 
		}
	}
}

function date_validation_obj(text_obj){

	//remove dashes
	text_obj.value= text_obj.value.replace(/\-+/g, '/');
	text_obj.value= text_obj.value.replace(/[^0-9\/]/g, '');
	//validate month
	text_obj.value= text_obj.value.replace(/^([0-9])\//g, '0$1/');
	//validate day
	text_obj.value= text_obj.value.replace(/\/([0-9])\//g, '/0$1/');
	//validate year
	text_obj.value= text_obj.value.replace(/\/([0-9])$/g, '/200$1');
	text_obj.value= text_obj.value.replace(/\/([5-9][0-9])$/g, '/19$1');
	text_obj.value= text_obj.value.replace(/\/([0-4][0-9])$/g, '/20$1');
	text_obj.value= text_obj.value.replace(/\/([0-9]{3})$/g, '/1$1');
	
	//text_obj.value= text_obj.value.replace(/\/([0-9])$/g, '/200$1');
	//text_obj.value= text_obj.value.replace(/\/([0-9]{2})$/g, '/20$1');
	//text_obj.value= text_obj.value.replace(/\/([0-9]{3})$/g, '/2$1');
	
	
	
	// 09/30/1981 01/34/6789
	//month
	if(text_obj.value.substring(0,2) >12){
		text_obj.value="12" + text_obj.value.substring(2,10);
	}
	//day
	if(text_obj.value.substring(3,5) > 31){
		text_obj.value= text_obj.value.substring(0,3) + "31" + text_obj.value.substring(5,10);
	}
	//year
	var thedate = new Date( );
	var year = thedate.getFullYear( );
	if((text_obj.value.substring(6,10) > (year+10)) | (text_obj.value.substring(6,10) < (year -130))){
		text_obj.value= text_obj.value.substring(0,6) +year; 
	}
	
}