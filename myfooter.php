
<script>
// alert("hellop");
// function show_sender(){
//     // console.log("hello");
// 	document.getElementById("hide_sender").removeAttribute("style");
// 	document.getElementById("hide_receiver").removeAttribute("style");
// 	document.getElementById("show_pricing").removeAttribute("style");
//     document.getElementById("hide_parcel_desc").setAttribute("style", "display: none;");
// 	// document.getElementById("generate_quote").removeAttribute("style");
//     document.getElementById("generate_quote").style.visibility = "hidden";
// }

// document.getElementById("generate_quote").addEventListener("click",show_sender,'false');


(function($) {
    $(document).ready(function() {

// $( "#dialog21" ).dialog();
        // window.addEventListener('load', function(){
        //     $("#show_price1").hide();
        // }, false);


// 		$('.send_quote').submit(function() {
// alert("Your order has been received and our representative will contact you shortly. The order details has been emailed to provided Sender’s email address. Thank you for visiting our website.\n Anytime Delivery");
//     	});

        $('#generate_quote').click(function() {
            // var type = $("input[name=type]").val();


            // document.getElementById("show_pricing").removeAttribute("style");
            // $("#show_pricing").css({
            //     'display': 'block'
            // });
            val_weight();
            val_length();
            val_height();
            val_width();
            val_sender_postcode();
            val_receiver_city();

            if (val_weight() === true && val_length() === true && val_width() === true && val_height() === true && val_sender_postcode() === true && val_receiver_city() === true) 
            {
                // return;
                var type = $('input[name="type"]:checked').val();
                if (type == 'air')
                    var type_str = 'Air Cargo';
                if (type == 'sea')
                    var type_str = 'Sea Cargo';

                var courier_service = $('input[name="courier_service"]:checked').val();
                if (courier_service == 'collected')
                    var courier_service_str =
                        'The parcel will be collected by Courier Company from Sender Address';
                else
                    var courier_service_str = 'The parcel will be delivered to Courier Company Office';


                var weight= $("input[name='weight[]']").map(function(){return $(this).val();}).get();
                var width= $("input[name='width[]']").map(function(){return $(this).val();}).get();
                var height= $("input[name='height[]']").map(function(){return $(this).val();}).get();
                var lenght= $("input[name='lenght[]']").map(function(){return $(this).val();}).get();

                var data ="";
                var to = $("#to").val();
                var fee = 0;
                var total_fee=0;
                var total_boxes = 0;

                if (type == 'sea' && to == 'india' || weight.length < 1) {
                    alert('Unable to proceed. Please try again.');
                } 
                else 
                {
                    // document.getElementById("hide_sender").removeAttribute("style");
                    $("#hide_sender").css({
                        'display': 'block'
                    });
                    // document.getElementById("hide_receiver").removeAttribute("style");
                    $("#hide_receiver").css({
                        'display': 'block'
                    });
                    // document.getElementById("hide_parcel_desc").setAttribute("style", "display: none;");
                    $("#hide_parcel_desc").css({
                        'display': 'none'
                    });
                    // document.getElementById("generate_quote").style.visibility = "hidden";
                    $(".hide_gen_q").css({
                        'display': 'none'
                    });
                    // document.getElementById("show_pricing").removeAttribute("style");
                    $("#show_price1").removeClass('hidden123');

                    if (weight.length > 0) {

                        for(var i=0; i<weight.length; i++){
                            weight[i]=parseInt(weight[i]);
                            width[i]=parseInt(width[i]);
                            height[i]=parseInt(height[i]);
                            lenght[i]=parseInt(lenght[i]);
                

                            if (type == 'air' && to == 'india') {
                                fee = 6.50;
                            } else if (type == 'air' && to == 'pakistan') {
                                fee = 5.00;
                            } else if (type == 'sea' && to == 'pakistan') {
                                fee = 1.50;
                            }
                            fee = fee * weight[i];
                            total_fee+=fee;
                            box = Math.ceil(weight[i] / 20);
                            total_boxes = total_boxes + box;
                            if (box == 1) {
                                box_str = 'Box';
                            } else {
                                box_str = 'Boxes';
                            }

                            data += '<tr><td>' + weight[i].toString() + 'kg</td><td>'+lenght[i].toString() +'cm</td><td>' + width[i].toString() + 'cm</td><td>' + height[i].toString() +'cm</td><td>Use ' + box.toString() + ' x 20 kg ' + box_str.toString() +'</td><td>&pound;' + fee.toString() + '</td></tr>';
                        }
                        var head11='<table class="table" width="700">'+'<tr><th style="text-align: left;">Weight</th><th style="text-align: left;">Length</th><th style="text-align: left;">Width</th><th style="text-align: left;">Height</th><th style="text-align: left;">Box(es)</th><th style="text-align: left;">Cost</th></tr>';
                        var foot11='</table>';
                        var total_fee_str='<h2 class="total_am">Total Amount: &pound;'+total_fee.toString()+' </h2>';
                        document.getElementById("show_pricing").innerHTML=head11+data+foot11+total_fee_str;
                    }
                }
                // var weight = $("#weight").spinner().val();
            } 
            else 
            {
                alert("Please Fill out all fields");
            }
        });
    });



function val_sender_postcode() {
    // $(".error").remove();
    var postcode = $("input[name='from_postcode']");
    var code = postcode.val();
    // var pregex = new RegExp(/^[0-9]{5}$/);

    if (code.length < 4) {
        postcode.css({ "border": "2px solid red" });
        // postcode.after('<span style="font-size:13px; color:#900;" class="error">Required</span>');
        // postcode.focus();
        return false;
    } 
    // else if (!pregex.test(postcode)) {
    //     postcode.css({ "border": "1px solid red" });
    //     // postcode.after('<span style="font-size:13px; color:#900;" class="error">Enter valid zip code</span>');
    //     postcode.focus();
    //     return false;
    // } 
    else {
        postcode.css({ "border": "none" });
        return true;
    }
} //end of function

function val_receiver_city() {
    var city = $("input[name='receiver_city']");
    var city_val = city.val();

    if (city_val.length < 3) {
        city.css({ "border": "2px solid red" });
        // city.focus();
        return false;
    } 
    else {
        city.css({ "border": "none" });
        return true;
    }
} //end of function


function val_weight() {
    var flag=true;
    var weight= $("input[name='weight[]']");
    var weight1= weight.map(function(){return $(this);}).get();
    var weight_arr= weight.map(function(){return $(this).val();}).get();
    
    for(var i=0; i<weight_arr.length;i++)
    {
        if(weight_arr[i].length==0){
            // alert("weight is empty", i);
            weight1[i].css({"border": "2px solid red"});
            // weight1[i].focus();
            flag= false;
        }
        else{
            weight1[i].css({"border": "none"});
        }
    }
    if(flag)
        return true;
    else
        return false;
} //end of function


function val_length() {
    var flag=true;
    var length= $("input[name='lenght[]']");
    var length1= length.map(function(){return $(this);}).get();
    var length_arr= length.map(function(){return $(this).val();}).get();
    
    for(var i=0; i<length_arr.length;i++)
    {
        if(length_arr[i].length==0){
            // alert("weight is empty", i);
            length1[i].css({"border": "2px solid red"});
            // length1[i].focus();
            flag= false;
        }
        else{
            length1[i].css({"border": "none"});
        }
    }
    if(flag)
        return true;
    else
        return false;
} //end of function

function val_width() {
    var flag=true;
    var width= $("input[name='width[]']");
    var width1= width.map(function(){return $(this);}).get();
    var width_arr= width.map(function(){return $(this).val();}).get();
    
    for(var i=0; i<width_arr.length;i++)
    {
        if(width_arr[i].length==0){
            // alert("weight is empty", i);
            width1[i].css({"border": "2px solid red"});
            // width1[i].focus();
            flag= false;
        }
        else{
            width1[i].css({"border": "none"});
        }
    }
    if(flag)
        return true;
    else
        return false;
} //end of function

function val_height() {
    var flag=true;
    var height= $("input[name='height[]']");
    var height1= height.map(function(){return $(this);}).get();
    var height_arr= height.map(function(){return $(this).val();}).get();
    
    for(var i=0; i<height_arr.length;i++)
    {
        if(height_arr[i].length==0){
            // alert("weight is empty", i);
            height1[i].css({"border": "2px solid red"});
            // height1[i].focus();
            flag= false;
        }
        else{
            height1[i].css({"border": "none"});
        }
    }
    if(flag)
        return true;
    else
        return false;
} //end of function


})(jQuery);
</script>

