<?php

require_once "./vendor/autoload.php";

// turn on error reporting for now
errorReporting();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    http_response_code(405);
    exit("Method not allowed");
}

try {
    $head = includeAndReplaceContents('includes/head.php', [
        'pageTitle' => 'Certificate Generator',
    ]);

    $header = includeAndReplaceContents('includes/header.php');
} catch (Exception $e) {
    echo $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">
    <?php if (isset($head)) { echo $head; } ?>

    <body>
        <?php if (isset($header)) { echo $header; } ?>

        <form action='./process.php' method="post" id="configuration-form">

            <label for='file-prefix' class="input-container">File Prefix
                <input type='text' name='file-prefix' required />
            </label>

            <label for='pdf-template' class="input-container">Certificate Template
                <select name="pdf-template">
                    <option value='default' disabled selected>Select A Template</option>
                    <option value='premortem-training'>Premortem Training</option>
                </select>
            </label>

        </form> 

        <script src="index.js"></script>
    </body>
</html>
