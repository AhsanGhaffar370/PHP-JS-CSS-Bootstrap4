// JavaScript Document// JavaScript Document
function showDiv() {
    document.getElementById('hide_test').style.display = "block";
    document.getElementById('btn111').style.display = "none";
}




$(document).ready(function() {
    if ($("#color1").text() == "Active") {
        $("#color1").css("color", "red");
    }
});

$(document).ready(function() {
    $("#b").click(function() {
        $(".div1").show();
        $("#b").hide();
    });
});

$(document).ready(function() {
    $("#b1").click(function() {
        $(".div2").show();
        $("#b1").hide();
    });
});

$(document).ready(function() {
    $("#b2").click(function() {
        $(".div3").show();
        $("#b2").hide();
    });
});


/////////////////////////////////////ser_city Information
$(document).ready(function() {

    $("#country").focusout(function() {
        // check_state();
    });

    $('.ser_state').submit(function(e) {
        // check_state();

        if (check_ser_state() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});


/////////////////////////////////////client form Information
$(document).ready(function() {

    $("#fname").focusout(function() {
        // check_fname();
    });

    $("#email").focusout(function() {
        // check_mail();
    });

    $("#mob").focusout(function() {
        // check_mob();
    });

    $("#law_cat").focusout(function() {
        // check_law_cat();
    });

    $("#msg").focusout(function() {
        // check_law_cat();
    });

    $('.client-form1').submit(function(e) {
        check_fname();
        check_mail();
        check_mob();
        check_law_cat();
        check_msg();

        if (check_fname() === true && check_mail() === true && check_mob() === true && check_law_cat() === true && check_msg() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});

/////////////////////////////////////Lawyer Sign In Information
$(document).ready(function() {

    $("#email").focusout(function() {
        // check_mail();
    });

    $("#pass").focusout(function() {
        // check_pass1();
    });

    $('.lawyer-signIn-form1').submit(function(e) {
        check_mail();
        check_pass();


        if (check_mail() === true && check_pass() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});


/////////////////////////////////////Lawyer Sign Up Information
$(document).ready(function() {


    $("#fname").focusout(function() {
        // check_fname();
    });

    $("#organ").focusout(function() {
        // check_organ();
    });

    $("#email").focusout(function() {
        // check_mail();
    });

    $("#mob").focusout(function() {
        // check_mobile();
    });

    $("#state").focusout(function() {
        // check_state();
    });

    $("#zip").focusout(function() {
        // check_zip();
    });

    $("#pass").focusout(function() {
        // check_pass();
    });

    $('.lawyer-form1').submit(function(e) {
        check_fname();
        check_organ();
        check_mail();
        check_mob();
        check_state();
        check_zip();
        check_pass();

        if (check_fname() === true && check_organ() === true && check_mail() === true && check_mob() === true && check_state() === true && check_zip() === true && check_pass() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});

/////////////////////////////////////Contact Us Info
$(document).ready(function() {

    $("#fname").focusout(function() {
        // check_fname();
    });
    $("#lname").focusout(function() {
        // check_lname();
    });

    $("#email").focusout(function() {
        // check_mail();
    });

    $("#mob").focusout(function() {
        // check_mob();
    });


    $("#msg").focusout(function() {
        // check_law_cat();
    });

    $('.contact-form1').submit(function(e) {
        check_fname();
        check_lname();
        check_mail();
        check_mob();
        check_msg();

        if (check_fname() === true && check_lname() === true && check_mail() === true && check_mob() === true && check_msg() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});

/////////////////////////////////////sms
$(document).ready(function() {

    $("#mob").focusout(function() {
        // check_mob();
    });

    $('.sms-form1').submit(function(e) {
        check_mob();

        if (check_mob() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});


/////////////////////////////////////Payment Information
$(document).ready(function() {

    $("#name").focusout(function() {
        // check_name();
    });
    $("#money").focusout(function() {
        // check_money();
    });
    $("#email").focusout(function() {
        // check_mail();
    });
    $("#card_number").focusout(function() {
        // check_card_num();
    });
    $("#cvc").focusout(function() {
        // check_cvc();
    });
    $("#card_exp_month").focusout(function() {
        // check_month();
    });
    $("#card_exp_year").focusout(function() {
        // check_year();
    });


    $('.payment-form1').submit(function(e) {
        // check_card_num();
        // check_cvc();
        // check_month();
        // check_year();

        if (check_name() === true && check_money() === true && check_mail() === true && check_card_num() === true && check_cvc() === true && check_month() === true && check_year() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});

function check_fname() {
    $(".error").remove();
    var fregex = new RegExp(/^[a-zA-Z\s]{3,30}$/);
    var fname = $("#fname").val();

    if (fname.length < 1) {
        $("#fname").css({ "border": "1px solid red", "padding": "10px" });
        $('#fname').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#fname").focus();
        return false;
    } else if (!fregex.test(fname)) {
        $("#fname").css({ "border": "1px solid red", "padding": "10px" });
        $('#fname').after('<span style="font-size:13px; color:#900;" class="error">Please provide valid Name</span>');
        $("#fname").focus();
        return false;
    } else {
        $("#fname").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_lname() {
    $(".error").remove();
    var fregex = new RegExp(/^[a-zA-Z\s]{3,30}$/);
    var fname = $("#lname").val();

    if (fname.length < 1) {
        $("#lname").css({ "border": "1px solid red", "padding": "10px" });
        $('#lname').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#lname").focus();
        return false;
    } else if (!fregex.test(fname)) {
        $("#lname").css({ "border": "1px solid red", "padding": "10px" });
        $('#lname').after('<span style="font-size:13px; color:#900;" class="error">Please provide valid Name</span>');
        $("#lname").focus();
        return false;
    } else {
        $("#lname").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_name() {
    $(".error").remove();
    var fregex = new RegExp(/^[a-zA-Z\s]{3,30}$/);
    var fname = $("#name").val();

    if (fname.length < 1) {
        $("#name").css({ "border": "1px solid red", "padding": "10px" });
        $('#name').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#name").focus();
        return false;
    } else if (!fregex.test(fname)) {
        $("#name").css({ "border": "1px solid red", "padding": "10px" });
        $('#name').after('<span style="font-size:13px; color:#900;" class="error">Please provide valid Name</span>');
        $("#name").focus();
        return false;
    } else {
        $("#name").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_organ() {
    $(".error").remove();
    var fregex = new RegExp(/^[a-zA-Z\s]{3,30}$/);
    var organ = $("#organ").val();

    if (organ.length < 1) {
        $("#organ").css({ "border": "1px solid red", "padding": "10px" });
        $('#organ').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#organ").focus();
        return false;
    } else if (!fregex.test(organ)) {
        $("#organ").css({ "border": "1px solid red", "padding": "10px" });
        $('#organ').after('<span style="font-size:13px; color:#900;" class="error">Please provide valid organization name</span>');
        $("#organ").focus();
        return false;
    } else {
        $("#organ").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_pass() {
    $(".error").remove();
    var fregex = new RegExp(/^.{6,30}$/);
    var pass = $("#pass").val();

    if (pass.length < 1) {
        $("#pass").css({ "border": "1px solid red", "padding": "10px" });
        $('#pass').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#pass").focus();
        return false;
    } else if (!fregex.test(pass)) {
        $("#pass").css({ "border": "1px solid red", "padding": "10px" });
        $('#pass').after('<span style="font-size:13px; color:#900;" class="error">Please provide strong password</span>');
        $("#pass").focus();
        return false;
    } else {
        $("#pass").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_msg() {
    $(".error").remove();
    var matter = $("#msg").val();

    if (matter.length < 1) {
        $("#msg").css({ "border": "1px solid red", "padding": "10px" });
        $('#msg').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#msg").focus();
        return false;
    } else if (matter.length < 3) {
        $("#msg").css({ "border": "1px solid red", "padding": "10px" });
        $('#msg').after('<span style="font-size:13px; color:#900;" class="error">Please enter valid message</span>');
        $("#msg").focus();
        return false;
    } else {
        $("#msg").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function


function check_card_num() {
    $(".error").remove();
    var fregex = new RegExp(/^[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/);
    var card_num = $("#card_number").val();

    if (card_num.length < 1) {
        $("#card_number").css({ "border": "1px solid red", "padding": "10px" });
        $('#card_number').after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
        $("#card_number").focus();
        return false;
    } else if (!fregex.test(card_num)) {
        $("#card_number").css({ "border": "1px solid red", "padding": "10px" });
        $('#card_number').after('<span style="font-size:13px; color:#900;" class="error">Please provide valid card number</span>');
        $("#card_number").focus();
        return false;
    } else {
        $("#card_number").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function


function check_mail() {
    $(".error").remove();
    var eregex = new RegExp(/^\w+@\w+(\.\w+)+$/);
    var email = $("#email").val();

    if (email.length < 1) {
        $("#email").css({ "border": "1px solid red", "padding": "10px" });
        $('#email').after('<span style="font-size:13px; color:#900;" class="error">Email is required</span>');
        $("#email").focus();
        return false;
    } else if (!eregex.test(email)) {
        $("#email").css({ "border": "1px solid red", "padding": "10px" });
        $("#email").after('<span style="font-size:13px; color:#900;" class="error">Please provide valid email something like that xxx@mail.com</span>');
        $("#email").focus();
        return false;

    } else {
        $("#email").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function

function check_mob() {
    $(".error").remove();
    var mob = $("#mob").val();
    //^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$
    var pregex = new RegExp(/^[(\d\s\+\-\.\_\(\))]{9,22}$/);

    if (mob.length < 1) {
        $("#mob").css({ "border": "1px solid red" });
        $("#mob").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#mob").focus();
        return false;
    } else if (!pregex.test(mob)) {
        $("#mob").css({ "border": "1px solid red" });
        $("#mob").after('<span style="font-size:13px; color:#900;" class="error">Enter valid number Exp; xxxxxxxxxx</span>');
        $("#mob").focus();
        return false;
    } else {
        $("#mob").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

function check_zip() {
    $(".error").remove();
    var zip = $("#zip").val();
    var pregex = new RegExp(/^[0-9]{5}$/);

    if (zip.length < 1) {
        $("#zip").css({ "border": "1px solid red" });
        $("#zip").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#zip").focus();
        return false;
    } else if (!pregex.test(zip)) {
        $("#zip").css({ "border": "1px solid red" });
        $("#zip").after('<span style="font-size:13px; color:#900;" class="error">Enter valid zip code</span>');
        $("#zip").focus();
        return false;
    } else {
        $("#zip").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function


function check_cvc() {
    $(".error").remove();
    var cvc = $("#cvc").val();
    var pregex = new RegExp(/^[0-9]{4}$/);

    if (cvc.length < 1) {
        $("#cvc").css({ "border": "1px solid red" });
        $("#cvc").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#cvc").focus();
        return false;
    } else if (!pregex.test(cvc)) {
        $("#cvc").css({ "border": "1px solid red" });
        $("#cvc").after('<span style="font-size:13px; color:#900;" class="error">Enter valid CVC code</span>');
        $("#cvc").focus();
        return false;
    } else {
        $("#cvc").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

function check_month() {
    $(".error").remove();
    var month = $("#card_exp_month").val();
    var pregex = new RegExp(/^[0-9]{2}$/);

    if (month.length < 1) {
        $("#card_exp_month").css({ "border": "1px solid red" });
        $("#card_exp_month").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#card_exp_month").focus();
        return false;
    } else if (parseInt(month) < 1 || parseInt(month) > 12) {
        $("#card_exp_month").css({ "border": "1px solid red" });
        $("#card_exp_month").after('<span style="font-size:13px; color:#900;" class="error">Please enter valid month.</span>');
        $("#card_exp_month").focus();
        return false;
    } else if (!pregex.test(month)) {
        $("#card_exp_month").css({ "border": "1px solid red" });
        $("#card_exp_month").after('<span style="font-size:13px; color:#900;" class="error">Enter valid month</span>');
        $("#card_exp_month").focus();
        return false;
    } else {
        $("#card_exp_month").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

function check_year() {
    $(".error").remove();
    var year1 = $("#card_exp_year").val();
    var year = parseInt(year1);

    var pregex = new RegExp(/^[0-9]{4}$/);

    if (year1.length < 1) {
        $("#card_exp_year").css({ "border": "1px solid red" });
        $("#card_exp_year").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#card_exp_year").focus();
        return false;
    } else if (year < 2019 || year > 2050) {
        $("#card_exp_year").css({ "border": "1px solid red" });
        $("#card_exp_year").after('<span style="font-size:13px; color:#900;" class="error">Please enter valid year.</span>');
        $("#card_exp_year").focus();
        return false;
    } else if (!pregex.test(year1)) {
        $("#card_exp_year").css({ "border": "1px solid red" });
        $("#card_exp_year").after('<span style="font-size:13px; color:#900;" class="error">Enter valid year </span>');
        $("#card_exp_year").focus();
        return false;
    } else {
        $("#card_exp_year").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

function check_state() {
    $(".error").remove();
    var state = $("#state").val();

    if (state == null) {
        $("#state").css({ "border": "1px solid red" });
        $("#state").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#state").focus();
        return false;
    } else {
        $("#state").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

function check_ser_state() {
    $(".error").remove();
    var req = $("#country").val();

    if (req.length < 4) {
        $("#country").css({ "border": "1px solid red" });
        $("#country").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#country").focus();
        return false;
    } else {
        $("#country").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function


function check_law_cat() {
    $(".error").remove();
    var law_cat = $("#law_cat").val();

    if (law_cat == null) {
        $("#law_cat").css({ "border": "1px solid red" });
        $("#law_cat").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#law_cat").focus();
        return false;
    } else {
        $("#law_cat").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function


function check_money() {
    $(".error").remove();
    var zip = $("#money").val();
    var pregex = new RegExp(/^-?(?:0|[1-9]\d{0,2}(?:,?\d{3})*)(?:\.\d+)?$/);

    if (zip.length < 1) {
        $("#money").css({ "border": "1px solid red" });
        $("#money").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#money").focus();
        return false;
    } else if (!pregex.test(zip)) {
        $("#money").css({ "border": "1px solid red" });
        $("#money").after('<span style="font-size:13px; color:#900;" class="error">Enter valid amount</span>');
        $("#money").focus();
        return false;
    } else {
        $("#money").css({ "border": "2px solid green", "padding": "5px" });
        return true;
    }
} //end of function

/*
$(document).ready(function() {
 
    $("#ttype").focusout(function() {
        check_ttype();
    });
    
    $("#class").focusout(function() {
        check_class();
    });
    
    $("#ssub").focusout(function() {
        check_ssub();
    });
    
    $("#preferg").focusout(function() {
        check_preferg();
    });
        
    $("#duration").focusout(function() {
        check_duration();
    });
        
    $("#hours").focusout(function() {
        check_hours();
    });
    
    $("#hfrom").focusout(function() {
        check_hfrom();
    });
    $("#hto").focusout(function() {
        check_hto();
    });
    $("#req").focusout(function() {
        check_req();
    });	
    $("#budget").focusout(function() {
        check_budget();
    });		
    $("#smob").focusout(function() {
        check_smob();
    });	
 
    $('.stu-form2').submit(function(e) {
        check_ttype();
        check_cclass();
        check_ssub();
        check_preferg();
        check_duration();
        check_hours();
        check_hfrom();
        check_hto();
        check_budget();
        check_smob();
        check_req();
        
        if(check_ttype()===true && check_cclass()===true && check_ssub()===true && check_preferg()===true && check_duration()===true && check_hours()===true && check_hfrom()===true && check_hto()===true && check_req()===true && check_budget()==true && check_smob()==true){
            return;
        }
        else{
        e.preventDefault();}
    });
 
});
 
function check_ttype(){
    $(".error").remove();
    var subject = $("#ttype").val();
 
    if (subject == null) {
        $("#ttype").css({"border":"1px solid red"});
        $("#ttype").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#ttype").focus();
        return false;
        //$("#span0").css('display','block');
    }
    else {
        $("#ttype").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
        //$("#span0").css('display','block');
    }
}//end of function
 
function check_cclass(){
    $(".error").remove();
    var subject = $("#cclass").val();
 
    if (subject == null) {
        $("#cclass").css({"border":"1px solid red"});
        $("#cclass").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#cclass").focus();
        return false;
        //$("#span0").css('display','block');
    }
    else {
        $("#cclass").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
        //$("#span0").css('display','block');
    }
}//end of function
 
function check_ssub(){
    $(".error").remove();
    var subject = $("#ssub").val();
 
    if (subject == null) {
        $("#ssub").css({"border":"1px solid red"});
        $("#ssub").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#ssub").focus();
        return false;
        //$("#span0").css('display','block');
    }
    else {
        $("#ssub").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
        //$("#span0").css('display','block');
    }
}//end of function
 
 
function check_preferg(){
    $(".error").remove();
    var gender = $("#preferg").val();
 
    if (gender== null) {
        $("#preferg").css({"border":"1px solid red"});
        $("#preferg").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#preferg").focus();
        return false;
    }
    else {
        $("#preferg").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_duration(){
    $(".error").remove();
    var gender = $("#duration").val();
 
    if (gender== null) {
        $("#duration").css({"border":"1px solid red"});
        $("#duration").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#duration").focus();
        return false;
    }
    else {
        $("#duration").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_hours(){
    $(".error").remove();
    var gender = $("#hours").val();
 
    if (gender== null) {
        $("#hours").css({"border":"1px solid red"});
        $("#hours").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#hours").focus();
        return false;
    }
    else {
        $("#hours").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_hfrom(){
    $(".error").remove();
    var gender = $("#hfrom").val();
 
    if (gender== null) {
        $("#hfrom").css({"border":"1px solid red"});
        $("#hfrom").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#hfrom").focus();
        return false;
    }
    else {
        $("#hfrom").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_hto(){
    $(".error").remove();
    var gender = $("#hto").val();
 
    if (gender== null) {
        $("#hto").css({"border":"1px solid red"});
        $("#hto").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#hto").focus();
        return false;
    }
    else {
        $("#hto").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_smob(){
    $(".error").remove();
    var mob = $("#smob").val();
    var pregex= new RegExp(/^[0-9]{10}$/);
 
    if (mob.length < 1) {
        $("#smob").css({"border":	"1px solid red"});
        $("#smob").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#smob").focus();
        return false;
    }
    else if(!pregex.test(mob)){
        $("#smob").css({"border":	"1px solid red"});
        $("#smob").after('<span style="font-size:13px; color:#900;" class="error">Enter valid number</span>');
        $("#smob").focus();
        return false;
    }
    else {
        $("#smob").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_budget(){
    $(".error").remove();
    var bud = $("#budget").val();
    var pregex= new RegExp(/^[0-9]+$/);
 
    if (bud.length < 1) {
        $("#budget").css({"border":"1px solid red"});
        $("#budget").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#budget").focus();
        return false;
    }
    else if(!pregex.test(bud)){
        $("#budget").css({"border":	"1px solid red"});
        $("#budget").after('<span style="font-size:13px; color:#900;" class="error">Enter valid value</span>');
        $("#budget").focus();
        return false;
    }
    else {
        $("#budget").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
function check_req(){
    $(".error").remove();
    var req = $("#req").val();
 
    if (req.length < 1) {
        $("#req").css({"border":"1px solid red"});
        $("#req").after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
        $("#req").focus();
        return false;
    }
    else {
        $("#req").css({"border":"2px solid green" , "padding" : "5px"});
        return true;
    }
}//end of function
 
*/