function VALIDATION() {
	var name=document.forms["orgform"]["cname"];
	var gstnumber=document.forms["orgform"]["cnumber"];

	if(name.value==""){
		window.alert("Company name cannot be blank");
   	    name.focus(); 
    	return false; 
	}


	if(name.value==""){
		window.alert("GSt number cannot be blank");
   	    gstnumber.focus(); 
    	return false; 
	}

}



function check_empty() {
if (document.getElementById('name').value == "" || document.getElementById('number').value == "" ) {
alert("Fill All Fields !");
} else {
document.getElementById('form').submit();
alert("Added Successfully");
}
}

function div_show() {
document.getElementById('abc').style.display = "block";
}

function div_hide(){
document.getElementById('abc').style.display = "none";
}
