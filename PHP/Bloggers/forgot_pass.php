<?php
include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();

if(isset($_SESSION['username']))
	{	
header('location: admin/dashboard.php');
}

if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error .= "<p>Invalid email address please type a valid email address!</p>";
    } else {
        $query="select * from user where email=:email";
        $stmt = $db->prepare($query);

        if($stmt){
            $stmt->bindParam(':email',$email);
            $stmt->execute();

            if($stmt->rowCount() < 1){
                $error .= "<p>No user is registered with this email address!</p>";
            }
            
        }
        unset($stmt);
    }

    if ($error != "") {
        echo "<div class='error'>" . $error . "</div>
        <br /><a href='javascript:history.go(-1)'>Go Back</a>";
    } else {
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5(2418 * 2 + $email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;
        // Insert Temp Table
        $query="insert into password_reset_temp email=:email, gen_key=:gen_key, expDate=:expDate";
        $stmt= $db->prepare($query);

        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':gen_key',$key);
        $stmt->bindParam(':expDate',$expDate);
        $stmt->execute();
        unset($stmt);



        $output = '<p>Dear user,</p>';
        $output .= '<p>Please click on the following link to reset your password.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="http://www.eqan.net/reset_pass.php?
key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
            http://www.eqan.net/reset_pass.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
        $output .= '<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';
        $output .= '<p>Thanks,</p>';
        $output .= '<p>Bloggers Team</p>';
        $body = $output;
        $subject = "Password Recovery - Bloggers.com";

        $email_to = $email;
        $fromserver = "noreply@eqan.net";
        include("vendor/PHPMailer/PHPMailerAutoload.php");
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "mail.eqan.net"; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->Username = "noreply@eqan.net"; // Enter your email here
        $mail->Password = "password"; //Enter your password here
        $mail->Port = 25;
        $mail->IsHTML(true);
        $mail->From = "noreply@eqan.net";
        $mail->FromName = "eqan.net";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
        }
    }
} else {
?>
    <form method="post" action="" name="reset"><br /><br />
        <label><strong>Enter Your Email Address:</strong></label><br /><br />
        <input type="email" name="email" placeholder="username@email.com" />
        <br /><br />
        <input type="submit" value="Reset Password" />
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<?php } ?>