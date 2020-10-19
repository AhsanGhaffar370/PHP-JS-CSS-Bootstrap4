<?php 
// The strict declaration forces things to be used in the intended way.
//declare(strict_types=1); // strict requirement 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>First PHP Program</title>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes" />

    <!--
      Always put in header
      For ajax and jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css_prac1.css" type="text/css" rel="stylesheet" media="screen" />

    <!-- Bootstrap CSS (Latest compiled and minified CSS)-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/7516c4b4cc.js" crossorigin="anonymous"></script>

    <!-- 
    ################## 
            CSS  
    ###################  
    -->
    <style rel="stylesheet">
    .aaa1 {
        background-color: green !important;
    }

    .footer1 {
        position: fixed !important;
        bottom: 0;
        width: 100%;
    }
    </style>

</head>

<body class="ml_2 mr_2 mt_1">

    <header>
        <?php // include_once("header.php"); ?>
    </header>















    <h1 class="centre b8">PHP FORM HANDLING</h1>

    <section class="con " id="contact_1">
        <div class="form_grid">

            <div>
                <p class="size38 cl_b tl lh_1p4 b8 mb_2">Result:</p>
                <?php 
                    $nameErr=$emailErr=$genderErr=$stateErr=$reasonErr="";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") //check whether the form has been submitted using $_SERVER["REQUEST_METHOD"].
                    {
                        if ( empty($_POST["fname"]) )
                            $nameErr = "Full Name is required";
                        else {
                            $fname = test_input($_POST["fname"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z-' ]*$/",$fname))
                                $nameErr = "Only letters and white space allowed";
                            else 
                                echo "Name: $fname <br>";
                        }
                        
                        
                        if (empty($_POST["email"])) 
                            $emailErr = "Email is required";
                        else {
                            $email = test_input($_POST["email"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                                $emailErr = "Invalid email format";
                            else 
                                echo "Email: $email <br>";
                        }

                            
                        if(empty($_POST['gender']))
                            $genderErr= "Gender is required";
                        else{
                            $gender = test_input($_POST["gender"]);
                            echo "gender: $gender <br>";
                        }
                            
                        // $phoneNo = test_input($_POST["phoneNo"]);
                        // $zipcode = test_input($_POST["zipcode"]);
                        // $address = test_input($_POST["address"]);
                        
                        if(empty($_POST['state']))
                            $stateErr= "state is required";
                        else{
                            $state = test_input($_POST["state"]);
                            echo "state: $state <br>";
                        }
                            

                        if(empty($_POST['reason1']) && empty($_POST['reason2']))
                            $reasonErr= "Select Any one reason";
                        else{
                            if (!empty($_POST["reason1"]))
                                $reason1 = test_input($_POST["reason1"]);
                            else
                                $reason1= "Null";                       
                            
                            if (!empty($_POST["reason2"]))
                                $reason2 = test_input($_POST["reason2"]);
                            else
                                $reason2= "Null";  
                            
                            echo "1st Reason to Contact Us: $reason1 <br>";
                            echo "2nd Reason to Contact Us: $reason2 <br>"; 
                            echo "3rd Reason to Contact Us: Disable <br>";
                        }
                        
                        // $msg = test_input($_POST["msg"]);

                        // echo "phoneNo: $phoneNo <br>";
                        // echo "zipcode: $zipcode <br>";
                        // echo "address: $address <br>";
                        // echo "msg: $msg <br>";

                    }
                      
                    function test_input($data) {
                        // trim() method strip unnecessary characters (extra space, tab, newline) from the user input data
                        $data = trim($data); 
                        // strplashes() method remove backslashes (\) from the user input data
                        $data = stripslashes($data); 
                        /* The htmlspecialchars() function converts special characters to HTML entities. It replaces HTML characters like 
                        < and > with &lt; and &gt;. It prevents attackers from  exploiting the code by injecting HTML or JS code in forms.*/
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                ?>
            </div>



            <div>
                <p class="size38 cl_b tl lh_1p4 b8 mb_2">Contact Us</p>



                <!-- Form Starts -->
                <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="needs-validation1">

                    <div class="form-group">
                        <label class="b8" for="fname1">Full Name*:</label>
                        <input type="text" class="form-control p-4" id="fname1" name="fname" placeholder="Full Name" />
                        <span class="size13 cl_r"><?php echo $nameErr; ?></span>
                    </div>


                    <div class="form-group">
                        <label class="b8" for="email1">Email*:</label>
                        <input type="email" class="form-control p-4" id="email1" name="email" placeholder="Email" />
                        <span class="size13 cl_r"><?php echo $emailErr; ?></span>
                    </div>


                    <div class="form-group">
                        <label class="b8">Gender*:</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" id="male1" name="gender"
                                <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" />
                            <label class="form-check-label" for="male1"> Male </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" id="female1" name="gender" value="female" />
                            <label class="form-check-label" for="female1"> Female </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" id="other1" name="gender" value="other" />
                            <label class="form-check-label" for="other1"> Other </label>
                        </div>
                        <br>
                        <span class="size13 cl_r"><?php echo $genderErr; ?></span>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label class="b8" for="phoneno1">Phone No:</label>
                            <input type="tel" class="form-control p-4" id="phoneNo1" name="phoneNo"
                                placeholder="Phone No" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="b8" for="zipcode1">Zipcode:</label>
                            <input type="text" class="form-control p-4" id="zipcode1" name="zipcode"
                                placeholder="Zipcode" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="b8" for="address1">Address:</label>
                        <input type="text" class="form-control p-4" id="address1" name="address"
                            placeholder="Address" />
                    </div>


                    <div class="form-group">
                        <label class="b8" for="state1">State*:</label>
                        <select id="state1" name="state" class="form-control">
                            <option value="-1" disabled selected>Select State</option>
                            <option value="Sindh">Sindh</option>
                            <option value="Panjab">Panjab</option>
                            <option value="KPK">KPK</option>
                        </select>
                        <span class="size13 cl_r"><?php echo $stateErr; ?></span>
                    </div>


                    <div class="form-group">
                        <label class="b8">Reason To Contact Us*:</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Reason11" name="reason1" value="Reason1"
                                checked />
                            <label class="form-check-label" for="Reason11"> Reason1 </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Reason21" name="reason2"
                                value="Reason2" />
                            <label class="form-check-label" for="Reason21"> Reason2</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Reason31" name="reason3" value="Reason3"
                                disabled />
                            <label class="form-check-label" for="Reason31"> Reason3 </label>
                        </div>
                        <br>
                        <span class="size13 cl_r"><?php echo $reasonErr; ?></span>
                    </div>


                    <div class="form-group">
                        <label class="b8" for="fname">Message:</label>
                        <textarea class="form-control" id="msg1" name="msg" cols="20" rows="10"
                            placeholder="Message"></textarea>
                    </div>


                    <div class="">
                        <input type="submit" value="save" class="button btn_sm d_in b7" />
                    </div>
                </form>
                <!-- End of form -->
            </div>

        </div>
    </section>















    <footer>
        <?php // include_once("footer.php"); ?>
    </footer>


    <!-- After Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>


    <!-- 
    ################## 
        JAVASCRIPT 
    ###################  
    -->
    <script type="text/javascript">
    // document.write("<br/>Today is " + Date());


    // Disable form submissions if there are invalid fields
    (function() {
        "use strict";
        window.addEventListener(
            "load",
            function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(
                    form
                ) {
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();
    </script>


</body>

</html>