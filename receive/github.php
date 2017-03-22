<?php

    if(isset($_POST)) {

        // load variables
        require_once "../secrets.php";

        // validate secret
        $oursecret = "sha1=".hash_hmac("sha1", json_encode($_POST), $webhooksecret);
        $theirsecret = $_SERVER["HTTP_X_HUB_SIGNATURE"];

        if(hash_equals($theirsecret, $oursecret)) {
            http_response_code(401);
            echo "Invalid secret!<br />Make sure your secret in Stats and secret in your webhook are the same.<br />This incident has been reported.";
            // todo: connect to vucket and report security incident
        } else {
            // passed hash check
            $fp = fopen('github-'.microtime(true).'.txt', 'w');
            fwrite($fp, json_encode($_POST));
            fclose($fp);

            echo "Your yummy data has been received by Dvorak.";
        }

    } else {
        // No post data - go to github stats
        header("Location: https://stats.v0lture.com/#github");
    }

?>