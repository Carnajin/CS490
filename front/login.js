function loginRequest(){
    var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var xhrDisplay = document.getElementById('xhrDiv');
            xhrDisplay.innerHTML = xhr.responseText;
        }
    }

        var username = document.getElementById('user').value;
        var password = document.getElementById('password').value;

        var credentials = {"uidUsers": username, "pwdUsers": password};

    xhr.open('POST', MID_URL+"login.php", true);
    xhr.send(credentials);

}