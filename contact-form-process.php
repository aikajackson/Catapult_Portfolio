<?php
if (isset($_POST["email"])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "achikayamajackson@gmail.com";
    $email_subject = "Contact Form: New Inquiry";

    function problem($error)
    {
        echo "Error sending message";
        echo $error . "<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST["name"]) ||
        !isset($_POST["email"]) ||
        !isset($_POST["message"])
    ) {
        problem("Error sending message");
    }

    $name = $_POST["name"]; // required
    $email = $_POST["email"]; // required
    $phone = $_POST["phone"];
    $message = $_POST["message"]; // required

    $error_message = "Error sending message";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Email invalid <br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Name invalid <br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Message Invalid <br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Phone: " . clean_string($phone) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Message sent.

<?php
}
?>