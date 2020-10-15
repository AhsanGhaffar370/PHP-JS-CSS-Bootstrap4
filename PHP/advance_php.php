<?php 
// The strict declaration forces things to be used in the intended way.
//declare(strict_types=1); // strict requirement 
?>

<?php
// Start the session
session_start();
?>

<?php
    $cookie_name = "user";
    $cookie_value = "Ahsan ghaffar";
    $cookie_expire=time() + 3600; // 86400 = 1 day (The cookie will expire after 30 days )
    $cookie_path= "/"; // "/" means that the cookie is available in entire website (otherwise, select directory you prefer).

    // syntax: setcookie(name, value, expire, path, domain, secure, httponly);
    setcookie($cookie_name, $cookie_value, $cookie_expire, $cookie_path); //setcookie() function must appear BEFORE the <html> tag.

    // DELETE COOKIE
    // To delete a cookie, use the setcookie() function with an expiration date in the past:
    // set the expiration date to one hour ago
    // setcookie("user", "", time() - 3600);
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

<body class="ml_2 mr_2 mb_2 mt_2">

    <header>
        <?php // include_once("header.php"); ?>
    </header>

    <h1 class="centre b7">ADVANCED PHP </h1>









    <?php



        
    ////////////////////////////////////////////////////////
    // Useful Builtin Functions
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> Useful Builtin Functions </u></h2>";

    echo "<p class='size22 mb_0 mt_2'>isset()</p>";

    echo 
    '
    <p>
        isset() function returns true if the variable exists and is not NULL, otherwise it returns false.
        <br><b>Note:</b> If multiple variables are supplied (for_exp; isset($var1, $var2, ..)), then this function will
        return true only if all of the variables are set.
        <br><b>Tip:</b> A variable can be unset with the unset() function. <br>
    </p>
    ';




        
    ////////////////////////////////////////////////////////
    // Iterables
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> Iterables </u></h2>";

    // Use an iterable function argument:
    function printIterable(iterable $myIterable) {
        foreach($myIterable as $item) {
          echo $item;
        }
    }
      
    $arr = ["a", "b", "c"];
    printIterable($arr);


    // Return an iterable:
    function getIterable():iterable {
    return ["a", "b", "c"];
    }
    
    $myIterable = getIterable();
    foreach($myIterable as $item) {
    echo $item;
    }
        






    ////////////////////////////////////////////////////////
    // COOKIES
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> COOKIES </u></h2>";

    echo "A cookie is a small file that the server embeds on the user's computer. Each time the same computer requests 
    a page with a browser, it will send the cookie too. With PHP, you can both create and retrieve cookie values.<br><br>";
    
    //  A cookie is created with the setcookie() function.
    // setcookie(name, value, expire, path, domain, secure, httponly); Only name parameter is required. All other parameters are optional.
    

    // $_COOKIE[$cookie_name]: Retrieve the value of the cookie "user"
    if(!isset($_COOKIE[$cookie_name])) 
        echo "Cookie named '" . $cookie_name . "' is not set!";
    else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }

    // Check if Cookies are Enabled
    if(count($_COOKIE) > 0) {
        echo "<br>Cookies are enabled. ", count($_COOKIE) ;
    } else {
        echo "<br>Cookies are disabled.";
    }
    
    echo "<br>Note: You might have to reload the page to see the value of the cookie.";






    
    ////////////////////////////////////////////////////////
    // Sessions
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> SESSIONS </u></h2>";

    echo "Session variables hold information about one single user, and are available to all pages in one application.";
    echo "Note: The session_start() function must be the very first thing in your document. Before any HTML tags.<br><br>";

    // Set session variables
    $_SESSION["favcolor"] = "green";
    $_SESSION["favanimal"] = "cat";
    echo "Session variables are set.";

    // remove all session variables
    // session_unset();

    // destroy the session
    // session_destroy(); 






    
    ////////////////////////////////////////////////////////
    // FILTERS
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> FILTERS </u></h2>";

    echo "PHP filters are used to validate and sanitize external input.<br>
    The PHP filter extension has many of the functions needed for checking user input, and is designed to make 
    data validation easier and quicker.<br>";


    echo '<h2 class="size22 b6 cl_b mt_2 mb_0 "> Why Use Filters? </h2>';
    echo "Invalid submitted data can lead to security problems and break your webpage!
    By using PHP filters you can be sure your application gets the correct input!<br>";


    echo '<table> <tr><th>Filter Name</th><th>Filter ID</th></tr>';
    foreach (filter_list() as $id =>$filter) {
        echo '<tr><td>' . $filter . '</td><td>' . filter_id($filter) . '</td></tr>';
    }
    echo'</table>';



    echo '<h2 class="size22 b6 cl_b mt_2 mb_0 "> filter_var() Function </h2>';
    echo "The filter_var() function both validate and sanitize data.<br>";



    echo '<h2 class="size18 b6 cl_b mt_2 mb_0 "> Sanitize a String </h2>';
    echo "The following example uses the filter_var() function to remove all HTML tags from a string:";

    $str = "<b><u>Hello World!</u></b>";
    $newstr = filter_var($str, FILTER_SANITIZE_STRING);
    echo "<br><br>Before Sanitization: ", $str;
    echo "<br>After Sanitization: ",$newstr;

        

    echo '<h2 class="size18 b6 cl_b mt_2 mb_0 "> Validate an Integer </h2>';
    echo "The following example uses the filter_var() function to check if the variable \$int is an integer.";

    $int = 100;

    if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
      echo("<br><br>Integer is valid");
    } else {
      echo("<br><br>Integer is not valid");
    }


    
    echo '<h2 class="size18 b6 cl_b mt_2 mb_0 "> Sanitize and Validate an Email Address </h2>';
    echo "The following example uses the filter_var() function to first remove all illegal characters from the \$email variable, then check if it is a valid email address:";

    $email_filter="john.doe@example.com";

    // Remove all illegal characters from email
    $email_filter = filter_var($email_filter, FILTER_SANITIZE_EMAIL);

    // Validate e-mail
    if (!filter_var($email_filter, FILTER_VALIDATE_EMAIL) === false) {
        echo("<br><br>$email_filter is a valid email address");
    } 
    else {
        echo("<br><br>$email_filter is not a valid email address");
    }





    
    ////////////////////////////////////////////////////////
    // Callback
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> Callback </u></h2>";

    echo "Callback is a function which is passed as an argument into another function.<br>
    To use a function as a callback function, pass a string containing the name of the function as the 
    argument of another function:<br>";

    function double($v){
        return ($v*$v);
    }

    function triple($a){
        return ($a()*$a()*$a()."<br>");
    }

    echo triple(function(){return 2*2;});



    function my_callback($item){
        return ("New_".$item);
    }
        
    $strings = ["apple", "orange", "banana", "coconut"];
    // array_map() is a php pre-defined function which sends each value of an array to a user-made 
    // function, and returns an array with new values, given by the user-made function.
    // Syntax: array_map(myfunction-->required, array1-->required, array2, array3, ...) 
    $lengths = array_map("my_callback", $strings);  
    print_r($lengths);




    ?>


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
    </script>


</body>

</html>