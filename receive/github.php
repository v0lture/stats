<?php

    // testing
    $fp = fopen('github-'.microtime(true).'.txt', 'w');
    fwrite($fp, json_encode($_POST));
    fclose($fp);

?>