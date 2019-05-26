<html>
    <body>
        <?php 
        require_once "Mail.php";
        $username = $_SERVER['USERNAME'];
        $password = $_SERVER['PASSWORD'];
        $smtpHost = 'ssl://smtp.gmail.com';
        $smtpPort = '465';
        $to = $_SERVER['TO_EMAIL'];
        $from =  $_SERVER['USERNAME'];

        $subject = 'Contact Form';
        $successMessage = 'Message successfully sent!';


        $replyTo = '';
        $name = '';
        $body = $_POST['email'];


        $headers = array(
            'From' => $name . " <" . $from . ">",
            'To' => $to,
            'Subject' => $subject
        );
        $smtp = Mail::factory('smtp', array(
                    'host' => $smtpHost,
                    'port' => $smtpPort,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password
                ));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo($mail->getMessage());
            header("HTTP/1.1 500 INTERNAL SERVER ERROR");
        } else {
            echo($successMessage);
            header("HTTP/1.1 200 OK");
        }
        ?>
    </body>
</html>