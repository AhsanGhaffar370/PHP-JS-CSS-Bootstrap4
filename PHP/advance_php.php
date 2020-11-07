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

    <h1 class="centre b7">PHP Advance Concepts and Functions </h1>









    <?php



        
    ////////////////////////////////////////////////////////
    // Useful PHP Builtin Functions
    ////////////////////////////////////////////////////////

    echo "<h2 class='b6 mt_2 size32'><u> Useful PHP Builtin Functions </u></h2>";

    echo "<p class='size24 cl_b mb_0 mt_2'>print_r()</p>";
    echo 
    '<p class="size13 mb_0">
    The print_r() function prints the information about a variable in a more human-readable way. <br>
    If variable is integer, float, or string, the value itself will be printed. If variable is array or object, this function returns keys and elements. <br>
    If the return parameter is set to TRUE, this function returns a string<br>
    <b>Syntax: </b> print_r(variable, return); <br>
    <b>variable</b>	Required. Specifies the variable to return information about  <br>
    <b>return</b>	Optional. When set to true, this function will return the information (not print it). Default is false
    </p>';

    echo "<p class='size17 b7 mb_0'> Example:</p>";
    $a = array("red", "green", "blue");
    $c=print_r($a, TRUE);
    echo $c,"<br>";

    $b = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    print_r($b);

    echo "<br>";
    $a = 22.5;
    print_r($a);



    
    echo "<p class='size24 cl_b mb_0 mt_2'>var_dump()</p>";
    echo 
    '<p class="size13 mb_0">
    The var_dump() function dumps information about one or more variables. The information holds type and value of the variable(s).<br>
    <b>Syntax: </b> var_dump(var1, var2, ...); <br>
    <b> var1, var2, ...</b>	 Required. Specifies the variable(s) to dump information from
    </p>';

    echo "<p class='size17 b7 mb_0'> Example:</p>";
    $a = 32;
    echo var_dump($a) . "<br>";
    $b = "Hello world!";
    echo var_dump($b) . "<br>";
    $c = 32.5;
    echo var_dump($c) . "<br>";
    $d = array("red", "green", "blue");
    echo var_dump($d) . "<br>";
    $e = array(32, "Hello world!", 32.5, array("red", "green", "blue"));
    echo var_dump($e) . "<br>";
    // Dump two variables
    echo var_dump($a, $b) . "<br>";




    echo "<p class='size24 cl_b mb_0 mt_2'>isset()</p>";
    echo 
    '<p class="size13 mb_0">
        isset() function returns true if the variable exists and is not NULL, otherwise it returns false.
        <br><b>Note:</b> If multiple variables are supplied (for_exp; isset($var1, $var2, ..)), then this function will
        return true only if all of the variables are set.
        <br><b>Tip:</b> A variable can be unset with the unset() function.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";

    $a = 0;
    // True because $a is set
    if (isset($a)) 
        echo "Variable 'a' is set.<br>";
    
    $b = null;
    // False because $b is NULL
    if (isset($b)) 
        echo "Variable 'b' is set.";
    
        
    
    echo "<p class='size24 cl_b mb_0 mt_2'>Data Type Validation</p>";

    echo "<p class='size17 b7 mb_0'> is_int()</p>";
    echo "<p class='size17 b7 mb_0'> is_float()</p>";
    echo "<p class='size17 b7 mb_0'> is_double()</p>";
    echo "<p class='size17 b7 mb_0'> is_string()</p>";
    echo "<p class='size17 b7 mb_0'> is_bool()</p>";
    echo "<p class='size17 b7 mb_0'> is_array()</p>";
    echo "<p class='size17 b7 mb_0'> is_null()</p>";


    echo "<p class='size24 cl_b mb_0 mt_2'>strip_tags()</p>";
    echo 
    '<p class="size13 mb_0">
    This function strips a string from HTML, XML, and PHP tags.  <br>
    <b>Syntax: </b> strip_tags(string,allow) <br>
    <b>string</b>	Required. Specifies the string to check <br>
    <b>allow</b>	Optional. Specifies allowable tags. These tags will not be removed
    </p>';

    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    echo strip_tags("<b><i>Hello  world!</i></b>");

    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    echo '<p class="size13 mb_0">In below example, we allow <\b> tags to be used (all other tags will be removed).</p>';
    echo strip_tags("Hello <b><i>world!</i></b>","<b>");




    echo "<p class='size24 cl_b mb_0 mt_2'>htmlspecialchars()</p>";
    echo 
    '<p class="size13 mb_0">
    The htmlspecialchars() function converts special characters to HTML entities. It replaces HTML characters like 
    < and > with & lt; and & gt; <br>
    It prevents attackers from  exploiting the code by injecting HTML or JS code in forms.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";
    echo htmlspecialchars("Jane & 'Tarzan'");




    echo "<p class='size24 cl_b mb_0 mt_2'>stripslashes()</p>";
    echo 
    '<p class="size13 mb_0">
    strplashes() method remove backslashes (\) from the user input data
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";
    echo stripslashes("Who\'s Peter Griffin?"); // it doesn't show result on browser




    echo "<p class='size24 cl_b mb_0 mt_2'>trim()</p>";
    echo 
    '<p class="size13 mb_0">
    trim() method strip unnecessary characters (extra space, tab, newline) from the user input data
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";
    echo trim("       Who\'s Peter       Griffin?"); // it doesn't show result on browser




    echo "<p class='size24 cl_b mb_0 mt_2'>str_replace()</p>";
    echo 
    '<p class="size13 mb_0">
    The str_replace() function replaces some characters with some other characters in a string. <br>
    <b>syntax:</b> str_replace(find,replace,string,count)<br>
    <b>Note</b>It is case sensitive.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    echo str_replace("world","Peter","Hello world!");
    
    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    echo str_replace("world","Peter","Hello world and world and World", $i);
    echo "<br>Total number of replacements of word Peter: $i";

    echo "<p class='size17 b7 mb_0'> Example3:</p>";
    $arr = array("blue","red","green","yellow");
    print_r(str_replace("red","<b>pink</b>",$arr));




    echo "<p class='size24 cl_b mb_0 mt_2'>str_ireplace()</p>";
    echo 
    '<p class="size13 mb_0">
    The str_ireplace() function replaces some characters with some other characters in a string. <br>
    <b>syntax:</b> str_replace(find,replace,string,count)<br>
    <b>Note</b>It is case insensitive.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    echo str_ireplace("world","Peter","Hello WORLD!");
    
    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    echo str_ireplace("WORLD","Peter","Hello world and world and World");




    echo "<p class='size24 cl_b mb_0 mt_2'>str_word_count()</p>";
    echo 
    '<p class="size13 mb_0">
    The str_word_count() function counts the number of words in a string. <br>
    <b>syntax:</b> str_word_count(string,return,char)<br>
    <b>string:</b> Required. Specifies the string to check<br>
    <b>Return:</b> Optional. Specifies the return value of the str_word_count() function.<br>
    0 - Default. Returns the number of words found<br>
    1 - Returns an array with the words from the string<br>
    2 - Returns an array where the key is the position of the word in the string, and value is the actual word<br>
    <b>char:</b> Optional. Specifies special characters to be considered as words.<br>
    <b>Note</b> It is case insensitive.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    echo "Total number of words in string (Hello world!) are: ",str_word_count("Hello world!");
    
    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    print_r(str_word_count("Hello world!",1));
    
    echo "<p class='size17 b7 mb_0'> Example3:</p>";
    print_r(str_word_count("Hello world!",2));
    
    echo "<p class='size17 b7 mb_0'> Example4:</p>";
    print_r(str_word_count("Hello world & good morning!",1));
    echo "<br>";
    print_r(str_word_count("Hello world & good morning!",1,"&")); // add special character to count




    echo "<p class='size24 cl_b mb_0 mt_2'>strcasecmp()</p>";
    echo 
    '<p class="size13 mb_0">
    The strcasecmp() function compares two strings. <br>
    <b>syntax:</b> strcasecmp(string1,string2)<br>
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";
    echo "The two strings are equal: ",strcasecmp("Hello world!","HELLO WORLD!"); // The two strings are equal
    echo "<br>String1 is 6 characters greater than string2: ",strcasecmp("Hello world","HELLO"); // String1 is greater than string2
    echo "<br>String1 is 7 characters less than string2: ",strcasecmp("Hello world!","HELLO WORLD! HELLO!"); // String1 is less than string2




    echo "<p class='size24 cl_b mb_0 mt_2'>str_split()</p>";
    echo 
    '<p class="size13 mb_0">
    The str_split() function splits a string into an array. <br>
    <b>syntax:</b> str_split(string,length)<br>
    <b>string:</b>	Required. Specifies the string to split<br>
    <b>length:</b>	Optional. Specifies the length of each array element. Default is 1  <BR>
    <b>NOTE:</b> If length is less than 1, the str_split() function will return FALSE.  If length is larger than the length of string, the entire string will be returned as the only element of the array.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";

    echo print_r(str_split("Hello"));
    echo "<br>",print_r(str_split("Hello World",3));



    
    echo "<p class='size24 cl_b mb_0 mt_2'>explode()</p>";
    echo 
    '<p class="size13 mb_0">
    The explode() function breaks a string into an array. <br>
    <b>syntax:</b> explode(separator,string,limit)<br>
    <b>separator:</b>	Required. Specifies where to break the string <br>
    <b>string:</b>	Required. The string to split <br>
    <b>limit:</b>	Optional. Specifies the number of array elements to return. <br>
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    $input1 = "one,two,three,four";
    $input2 = "04/30/1973";
    $input3 = ',';
    echo print_r( explode( ',', $input1 ) );
    echo "<br>",print_r( explode( '/', $input2 ) );
    echo "<br>",print_r( explode( ',', $input3 ) );

    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    $str = 'one,two,three,four';
    // zero limit
    echo print_r(explode(',',$str,0)); //0 - Returns an array with one element
    // positive limit
    echo "<br>",print_r(explode(',',$str,2)); //Greater than 0 - Returns an array with a maximum of limit element(s)
    // negative limit 
    echo "<br>",print_r(explode(',',$str,-2)); // Less than 0 - Returns an array except for the last -limit elements()



    echo "<p class='size24 cl_b mb_0 mt_2'>PHP Regular Expression Functions</p>";
    
    echo "<p class='size20 cl_b mb_0 mt_2'>preg_split()</p>"; 
    echo 
    '<p class="size13 mb_0">
    The preg_split() function breaks a string into an array using matches of a regular expression as separators. <br>
    <b>syntax:</b> preg_split(pattern, string, limit, flags)<br>
    <b>pattern</b>	Required. A regular expression determining what to use as a separator <br>
    <b>string:</b>	Required. The string that is being split <br>
    <b>limit:</b>	Optional. Specifies the number of array elements to return. (work same as limit parameter of explode function) <br>
    <b>flags:</b>	Optional. These flags provide options to change the returned array: <br>
        <b>PREG_SPLIT_NO_EMPTY</b> - Empty strings will be removed from the returned array. <br>
        <b>PREG_SPLIT_DELIM_CAPTURE</b> - it also include the delmites in an array<br>
        <b>PREG_SPLIT_OFFSET_CAPTURE</b> - It return an multidimensional array. With every element, it stores it possition also. <br>
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";
    $string = "Hello,my name is ahsan. How are you/Hope you'll be fine."; 
    $pattern='/[\s.,\/]/'; // split on the basis of (space, comman, full-stop and /)
    print_r(preg_split($pattern, $string)); 

    echo "<p class='size17 b7 mb_0'> Example: (PREG_SPLIT_NO_EMPTY)</p>";
    $string = "1970-01-01--";
    $pattern = "/([-:])/";
    $components = preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY); //Empty strings will be removed from the returned array.
    print_r(preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY));   //Empty strings will be removed from the returned array.

    echo "<p class='size17 b7 mb_0'> Example: (PREG_SPLIT_DELIM_CAPTURE)</p>";
    $string = "1970-01-01 00:00:00";
    $pattern = "/([-\s:])/"; // to implement PREG_SPLIT_DELIM_CAPTURE. we have to put our regex inside round braces
    print_r(preg_split($pattern, $string, -1, PREG_SPLIT_DELIM_CAPTURE)); //it also include the delmites in an array

    echo "<p class='size17 b7 mb_0'> Example: (PREG_SPLIT_OFFSET_CAPTURE)</p>";
    $string = "1970-01-01";
    $pattern = "/[-]/";
    print_r(preg_split($pattern, $string, -1, PREG_SPLIT_OFFSET_CAPTURE)); //It return an multidimensional array. With every element, it stores it possition also.
    





    echo "<p class='size20 cl_b mb_0 mt_2'>preg_match() and preg_match_all()</p>";
    echo 
    '<p class="size13 mb_0">
    The preg_match() function returns whether a match was found in a string. <br>
    <b>syntax:</b> preg_match(pattern, input, matches, flags, offset) --> same syntax for preg_match_all()<br>
    <b>matches</b>	Optional. The variable used in this parameter will be populated with an array containing all of the matches that were found <br>
    <b>flags</b>	Optional. <b>PREG_OFFSET_CAPTURE</b> - it return the position of very first matched element. <br>
    <b>offset</b>	Optional. Defaults to 0. from where to start searching.<br>
    <b>NOTE</b> See example 3 and 4 to see the comparison between match() and match_all()
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";
    echo preg_match("/w3schools/i", "Visit W3Schools");

    echo "<p class='size17 b7 mb_0'> Example2:</p>";
    echo preg_match("/w3schools/i", "Welcome to W3Schools and W3Schools", $matches, PREG_OFFSET_CAPTURE,12),"<br>";
    print_r($matches);

    echo "<p class='size17 b7 mb_0'> Example3: (match)</p>";
    echo preg_match("/w3schools/i", "Welcome to W3Schools and W3Schools", $matches, PREG_OFFSET_CAPTURE),"<br>";
    print_r($matches);

    echo "<p class='size17 b7 mb_0'> Example4: (match_all)</p>";
    echo preg_match_all("/w3schools/i", "Welcome to W3Schools and W3Schools", $matches, PREG_OFFSET_CAPTURE),"<br>";
    print_r($matches);






    echo "<p class='size20 cl_b mb_0 mt_2'>preg_grep()</p>";
    echo 
    '<p class="size13 mb_0">
    The preg_grep() function returns an array containing only elements from the input that match the given pattern. <br>
    <b>syntax:</b> preg_grep(pattern, input, flags)<br>
    <b>flag:</b>	Optional. There is only one flag for this function. Passing the constant <b>PREG_GREP_INVERT</b> will make the function return only items that do not match the pattern.
    </p>';
    echo "<p class='size17 b7 mb_0'> Example:</p>";

    $input = ["Red","Pink","Green","Blue","Purple"];
      
    $result = preg_grep("/^p/i", $input);
    print_r($result);



    


    echo "<p class='size20 cl_b mb_0 mt_2'>preg_filter() & preg_replace()</p>";
    echo 
    '<p class="size13 mb_0">
    The preg_filter() function returns a string or array of strings in which matches of the pattern have been replaced with the replacement string. <br>
    <b>syntax:</b> preg_filter(pattern, replacement, input, limit, count) --> same syntax for preg_replace()<br>
    <b>NOTE</b> See example 2 and 3 to see the comparison between preg_filter() and preg_replace()
    </p>';
    echo "<p class='size17 b7 mb_0'> Example1:</p>";

    $input = ["It is 5 o'clock","40 days","No numbers here","In the year 2000"];
    $result = preg_filter('/[0-9]+/', '($0)', $input,500,$count);
    print_r($result);
    echo "<br>$count";

    echo "<p class='size17 b7 mb_0'> Example2: (preg_filter)</p>";
    $result = preg_filter('/[0-9]+/', 'replaced', $input);
    print_r($result);

    echo "<p class='size17 b7 mb_0'> Example3: (preg_replace)</p>";
    $result = preg_replace('/[0-9]+/', 'replaced', $input);
    print_r($result);









    
    echo "<h2 class='b6 mt_2 size32'><u> PHP Advance Concepts </u></h2>";


    ////////////////////////////////////////////////////////
    // Iterables
    ////////////////////////////////////////////////////////

    echo "<br><br><br><br><h2 class='b6 mt_2 size32'><u> Iterables </u></h2>";

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