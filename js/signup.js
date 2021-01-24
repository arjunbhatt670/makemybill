function check(){
	p1=document.getElementById("pass1").value;
	p2=document.getElementById("pass2").value;
	var email = document.getElementById("emailerror").innerHTML;
	var pass1 = document.getElementById("passerror").innerHTML;
	var pass2 = document.getElementById("passerror2").innerHTML;
	var mobno = document.getElementById("mobnoerror").innerHTML;

		if(p1!=p2){
			document.getElementById("passerror2").innerHTML="Password Do not Match" ;
			return false;
		} else {
			document.getElementById("passerror2").innerHTML="" ;
		}

	if(email == '' && pass1 == '' && pass2 == '' &&  name == "" && mobno == '') {
		//document.getElementById("reguser").submit();
						 return true;
	}
	else {
	// alert("Fill in with correct information");
						 return false;
	}
	
}

function check_confirm(){
	p1=document.getElementById("pass1").value;
	p2=document.getElementById("pass2").value;

	if(p1!=p2){
		document.getElementById("passerror2").innerHTML="Password Do not Match" ;
		return false;
	} else {
		document.getElementById("passerror2").innerHTML="" ;
	}

	var pass1 = document.getElementById("passerror").innerHTML;
	var pass2 = document.getElementById("passerror2").innerHTML;

	if(pass1 == '' && pass2 == '') 
		return true;
	else {
		return false;
	}

}

