function validate_form() {

    var email = document.forms['form52']['email'].value;
    var pass = document.forms['form52']['pass'].value;

    if (validate_email(email) && check_pass(pass)) {
        alert("form submit successfully!");
        // return true;
        return false;
    } else {
        return false;
    }
}


function validate_email(email) {

    var email_id= document.getElementById("email1");

    var email_re = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\. \-]+\.[a-zA-z0-9]{2,4}$/);

    if (email.length < 1) {
        alert("Email is required");
        email_id.style.background = "yellow";
        email_id.focus();
        return false;
    } else if (!email_re.test(email)) {
        alert("Invalid Email Address");
        email_id.style.background = "yellow";
        email_id.focus();
        return false;
    } else {
        email_id.style.background = "white";
        return true;
    }
}

function check_pass(pass) {

    var pass_id= document.getElementById("pass1");

    var pass_re = new RegExp(/^.{6,30}$/);

    if (pass.length < 1) {
        alert("Password is required");
        pass_id.style.background = "yellow";
        pass_id.focus();
        return false;
    } else if (!pass_re.test(pass)) {
        alert("Please provide strong password");
        pass_id.style.background = "yellow";
        pass_id.focus();
        return false;
    } else {
        pass_id.style.background = "white";
        return true;
    }
} //end of function



//dropdown validation

// function checkForSelection() {
//     if (document.getElementById("states").selectedIndex === 0) {
//         alert("Please select a state.");
//         return false;
//     }
// }


// radio button validation

// function validateRadios() {
//     var radios = document.getElementsByName("r1");
//     for (var i = 0; i < radios.length; i++) {
//         if (radios[i].checked) {
//             return true;
//         }
//     }
//     alert("Please check one.");
//     return false;
// }


//zipcode validation

// function validateZIP() {
//     var valueEntered = document.getElementById("zip").value;
//     var numChars = valueEntered.length;
//     if (numChars < 5) {
//         alert("Please enter a 5-digit code.");
//         return false;
//     }
//     for (var i = 0; i <= 4; i++) {
//         var thisChar = parseInt(valueEntered[i]);
//         if (isNaN(thisChar)) {
//             alert("Please enter only numbers.");
//             return false;
//         }
//     }
// }


//email validation

// function validateEmail() {
//     var addressIsLegal = true;
//     var eEntered = document.getElementById("email").value;
//     if (eEntered.indexOf(" ") !== -1) {
//         addressIsLegal = false;
//     }
//     if (eEntered.indexOf("@") < 1 || eEntered.indexOf("@") > eEntered.length - 5) 
//     {
//         addressIsLegal = false;
//     }
//     if (eEntered.indexOf(".") - eEntered.indexOf("@") < 2 || eEntered.indexOf(".") > eEntered.length - 3) {
//         addressIsLegal = false;
//     }
//     if (addressIsLegal === false) {
//         alert("Please correct email address");
//         return false;
//     }
// }
    

// password validation

// function checkPassword() {
//     try {
//         var pass = document.getElementById("f1").value;
//         if (pass.length < 8) {
//             throw "Please enter at least 8 characters.";
//         }
//         if (pass.indexOf(" ") !== -1) {
//             throw "No spaces in the password, please.";
//         }
//         var numberSomewhere = false;
//         for (var i = 0; i < pass.length; i++) {
//             if (isNaN(pass(i, i+1)) === false) {
//             numberSomewhere = true;
//             break;
//         }
//         }
//         if (numberSomewhere === false) {
//             throw "Include at least 1 number.";
//         }
//     }
//     catch(err) {
//         alert(err);
//     }
// }
    
    