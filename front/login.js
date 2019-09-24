
function loginRequest(){
    var username = document.getElementById('username:login').value;
    var password = document.getElementById('password:login').value;

    if(username.length == 0 | password.length == 0 ){
        document.getElementById('text').innerHTML = "Please enter both UCID and password to log in.";
      return false;
    }
    
    else{
      document.getElementById('text').innerHTML = "";
    }

    var credentials= "username"+username+"password"+password;
// Ajax request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
            var xhrDisplay = document.getElementById('text');
            xhrDisplay.innerHTML = xhr.responseText;

                  // var FRONT_URL="https://web.njit.edu/~ajd88/cs490/front/";


    xhr.send(credentials);
        }
    }
}
