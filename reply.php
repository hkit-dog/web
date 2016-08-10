<?php
/**
 * Created by PhpStorm.
 * User: pixoria
 * Date: 25/3/2016
 * Time: 7:51 PM
 */

include("db_c.php");

require_once "captcha.php"; //Verify with Google reCaptcha


// Server Key
$secret = "secret";

// empty response
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($secret);

if (isset($_POST["cuser"])) {

    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    if ($response != null && $response->success) {

        //Escape all HTML to avoid JS/PHP injection
        $cuser = htmlspecialchars($_POST["cuser"]);
        $comment = htmlspecialchars($_POST["comment"]);
        $ip = $_SERVER['REMOTE_ADDR'];

        $escape = mysqli_real_escape_string($link, $content);


        $query_post = "INSERT INTO comment (cuser, comment, cip, ctime) VALUES ('$cuser','$comment', '$ip', NOW())";


        //mysqli_query($link, "SELECT * FROM content");
        if (mysqli_query($link, $query_post)) {

            echo null;

        } else {

            echo mysqli_error($link);

        }


        mysqli_close($link);


    } else {
        return null;
    }
} else {
    return null;
}

?>