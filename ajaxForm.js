window.addEventListener("load", init, false);

function init() {
	
	$ = function(arg) {return document.getElementById(arg);}
	
	// vars
	var name, lastname, txt, resDiv, cptDiv, statusDiv;
	
	// form data inputs
	name 		= $("name");
	lastname 	= $("lastname");
	txt 		= $("txt");
	
	resDiv 		= $("res"); 			// response data
	cptDiv 		= $("cpt");				// google captcha in div
	statusDiv 	= $("status");
	

	// ajax
	function sendData(formData) {
		var r = new XMLHttpRequest();
		
		r.addEventListener("loadstart",function(e) {statusDiv.innerHTML = "Send data...";}, false);
		r.addEventListener("progress",function(e) {statusDiv.innerHTML = "Send data...";}, false);
		
		r.addEventListener("load",function(e) {
			
			statusDiv.innerHTML = "data is sent";
			if(e.target.responseText != "fail") {
				resDiv.innerHTML = e.target.responseText; 
				cptDiv.style = "border: none";
				grecaptcha.reset();
			} else cptDiv.style = "border: 2px solid red";
			
		}, false);
		
		r.open("POST", "post.php");
		r.send(formData);
	}
	
	
	// form submit
	$("form").addEventListener("submit", function(e) {

		resDiv.innerHTML = "";
		
		
		// check
		if(name.value && lastname.value && txt.value) {
		
			// form data
			var formData = new FormData();
			
			formData.append("name", encodeURIComponent(name.value));
			formData.append("lastname", encodeURIComponent(lastname.value));
			formData.append("txt", encodeURIComponent(txt.value));
			formData.append("g-recaptcha-response", grecaptcha.getResponse());
			
			// google check & sending
			if(grecaptcha.getResponse()) {
				cptDiv.style = "border: none";
				sendData(formData);
			} else {
				cptDiv.style = "border: 2px solid red";
			}
			
		} else alert("Fields are empty!");

		
		// sending ajax
		e.preventDefault();
		return false;
		
	}, false);


}
