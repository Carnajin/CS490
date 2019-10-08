
function loginRequest(){
    var username = document.getElementById('username:login').value;
    var password = document.getElementById('password:login').value;

    if(username.length == 0 | password.length == 0 ){
        document.getElementById('text').innerHTML = "Please enter both UCID and password to log in.";
      return false;
    }
    
    else{
      document.getElementById('text').innerHTML = ""; // keep blank, no error.
    }

    var credentials = ("user" + username, "pass" + password);
// Ajax request
    var xhr = new XMLHttpRequest(); // init
    xhr.open("POST", "https://web.njit.edu/~ajd88/cs490/front/login.php", true); // post req
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // encoded url
	xhr.onreadystatechange = function(){ // check for readystate and status good
		if(this.readyState == 4 && this.status == 200){
            
            var xhrDisplay = document.getElementById('xhrDisplay');
            xhrDisplay.innerHTML = this.responseText;
        
        if (answerNJIT == 0){
            if (answerBack == 0){
                document.getElementById("answer").innerHTML = "No access to NJIT & No access to database";
            }
            else if(answerBack == 1){
                document.getElementById("answer").innerHTML = "No access to NJIT & Welcome to database";
            }
        }
        else if (answerNJIT == 1){
             if (answerBack == 0){
                document.getElementById("answer").innerHTML = "Welcome to NJIT & NO access to database";
            }
        }
    }
    };
    xhr.send(credentials);
    
}
