<?php 

// session start 

session_start();

// set cookies 

setcookie("username", @$_POST['username'] );

// Check user request


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    // Assign Variables

    
    $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);


    // print data
            echo $user . "<br>";
            echo $email . "<br>";
            echo $phone . "<br>";
            echo $msg . "<br>";

// Creating Array of Errors
$formErrors = array();

if (strlen($user) <= 3)
{
    $formErrors[] = 'Username must be larger than <strong>3</strong> chars';
}
if (strlen($msg) <= 10) {
    $formErrors[] = 'Message must be larger than <strong>10</strong> chars';
}

// if no error send the email [main (To, Sub, message, headers , parameters)]

// $to = 'youssefalcon30@gmail.com';
// $headers = 'From: ' . $mail;
// $subject = 'Contact Form';
// if (empty($formErrors)) {

    // mail($to, $subject, $msg, $headers);
// }

session_create_id(1);

// assign session parameters to form data

$_SESSION['username'] = $user;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;
$_SESSION['msg'] = $msg;

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/contact.css" />
</head>

<body>

    <!--- Start Form --->

    <div class="container">
        <h2 class="text-center">Contact us</h2>

        <form action="<?php
    echo $_SERVER['PHP_SELF']  ?>" method="POST" class="contact-form">

            <?php
    if (! empty($formErrors)) { ?>
            <div class="alert alert-danger" role="start">
                <?php
        foreach($formErrors as $error) {
            echo $error . "<br>";
        }
        ?>
            </div>
            <?php }

    ?>
            <div class="form-group">
                <input type="text" class="form-control username" name="username"
                    value="<?php if (isset($user)) {echo $user;} ?>" placeholder="Enter username">
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Username must be larger than <strong>3</strong> chars
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control email" name="email"
                    value="<?php if (isset($email)) {echo $email;} ?>" placeholder="Enter email">
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Email can't be <strong>Empty</strong>
                </div>
            </div>
            <input type="text" class="form-control" name="phone" value="<?php if (isset($phone)) {echo $phone;} ?>"
                placeholder="Enter phone number">

            <textarea class="form-control message" name="message" placeholder="Enter your message">
        </textarea>
            <div class="alert alert-danger custom-alert">
                Message must be larger than <strong>10</strong> chars
            </div>

            <input type="submit" class="btn btn-success" value="Send Message">
        </form>
    </div>

    <!--- end Form --->



    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>