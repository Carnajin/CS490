function loginRequest(){
    var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var xhrDisplay = document.getElementById('xhrDiv');
            xhrDisplay.innerHTML = xhr.responseText;
            console.log("readystate is good (4)")
        }
    }

        var username = document.getElementById('user').value;
        var password = document.getElementById('password').value;

        var credentials_json = {"uidUsers": username, "pwdUsers": password};

    xhr.open('POST', "login.php", true);
    xhr.send(JSON.stringify(credentials_json));

}