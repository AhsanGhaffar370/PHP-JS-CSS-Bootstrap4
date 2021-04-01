$(document).ready(function() {



    $(".img1").mouseenter(function() {
        $(".img1").css({ "border": "1px solid red" });
    });
    $(".img1").mouseleave(function() {
        $(".img1").css({ "border": "0px" });
    });

    // 1st way of doing 
    // $("#p1").mouseenter(function() {
    //     $("#p1").after('<span id="err" class="size13 cl_r b7 d_in">paragraph hover</span>');
    // });
    // $("#p1").mouseleave(function() {
    //     $("#err").hide();
    // });

    // 2nd way of doing  (jQuery Callback Functions)
    $("#p1").hover(function() {
            $("#p1").after('<span id="err" class="size13 cl_r b7 d_in"> (paragraph hovered)</span>');
            // console.log($('#p1').attr('class'));
            // console.log($('#p1').removeAttr('class'));
            // console.log($('#p1').addClass('b8'));
            // var a = ($('#p1').attr('class'));
            // console.log($('#p1').attr('class', a + ' b8'));
        },
        function() {
            $("#err").hide();
        }
    );

    $(".hide1").click(function() {
        $(".p2").toggle(1000);
    });


    //  (jQuery Callback Functions)
    $("#p0").hover(function() {
            $(this).css({ 'color': 'red' });
        },
        function() {
            $(this).css({ 'color': 'black' });
        }
    );

    //  (jQuery Callback Functions)
    $('#p0').click(function() {
        $(this).animate({
                opacity: 0.0,
                paddingLeft: '+=450'
            },
            1000,
            function() {
                $(this).remove();
            });
    });
});





$(document).ready(function() {

    $("#email").focusout(function() {
        check_mail();
    });

    $("#pass").focusout(function() {
        check_pass();
    });

    $('.form1').submit(function(e) {
        if (check_mail() === true && check_pass() === true) {
            return;
        } else {
            e.preventDefault();
        }
    });

});


//email validation function
function check_mail() {
    $("#err").remove();
    var email_re = new RegExp(/^\w+@\w+(\.\w+)+$/);
    var email = $("#email").val();

    if (email.length < 1) {
        $("#email").css({ "border": "1px solid red", "padding": "10px" });
        $('#email').after('<span id="err" class="size13 cl_r b7">Email is required</span>');
        // $("#email").focus();
        return false;

    } else if (!email_re.test(email)) {
        $("#email").css({ "border": "1px solid red", "padding": "10px" });
        $("#email").after('<span id="err" class="size13 cl_r b7">Please provide valid Email i.e:xxx@gmail.com</span>');
        // $("#email").focus();
        return false;


    } else {
        $("#email").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function


// password validation function
function check_pass() {
    $("#error").remove();
    var pass_re = new RegExp(/^.{6,30}$/);
    var pass = $("#pass").val();

    if (pass.length < 1) {
        $("#pass").css({ "border": "1px solid red", "padding": "10px" });
        $('#pass').after('<span id="err" class="size13 cl_r b7">Password is required</span>');
        // $("#pass").focus();
        return false;

    } else if (!pass_re.test(pass)) {
        $("#pass").css({ "border": "1px solid red", "padding": "10px" });
        $('#pass').after('<span id="err" class="size13 cl_r b7">Please provide strong password</span>');
        // $("#pass").focus();
        return false;

    } else {
        $("#pass").css({ "border": "2px solid green", "padding": "10px" });
        return true;
    }
} //end of function


//clearence saga link on brands images
// $(".term-308 #content, .term-755 #content, .term-767 #content, .term-681 #content, .term-771 #content, .term-434 #content, .term-492 #content").find("img").eq(0).wrap("<a href='https://asanbuy.pk/clearance-saga/'></a>");
// $(".term-308 #content, .term-755 #content, .term-767 #content, .term-681 #content, .term-771 #content, .term-434 #content, .term-492 #content").find("img").eq(0).attr("src", "https://asanbuy.pk/wp-content/uploads/2021/01/clearance-saga-inner-banner-asanbuy.pk_.jpg");

//wordpress ka kaam

// 	var term308=document.getElementsByClassName("term-308")[0];
// // 	var term308=document.getElementById("content").childNodes[1];
// 	term308.setAttribute("src","https://asanbuy.pk/wp-content/uploads/2021/01/clearance-saga-inner-banner-asanbuy.pk_.jpg");
// 	var img1=term308.outerHTML;
// 	var img2="<a href='https://asanbuy.pk/clearance-saga/'>"+img1+"</a>";
// 	term308.outerHTML=img2;

// 	term308.setAttribute('id',"ab212");
// 	document.getElementById("ab212").outerHTML=img2;

// 	var children = document.getElementsByClassName("term-308")[0];// any tag could be used here..

//   for(var i = 0; i< children.length;i++)
//   {
//     if (children.childNodes[i].getAttribute('id') == 'content') // any attribute could be used here
//     {
//      console.log("ahsan bhai");
//      console.log(children.childNodes[i].childNodes[1].outerHTML);

//     }
//   }
