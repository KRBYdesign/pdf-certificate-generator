<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./vendor/autoload.php";

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

        <form action='./process.php' method="post">
            <div class='input-container'>
                <label for='file-prefix'>File Prefix
                    <input type='text' name='file-prefix' required />
                </label>
            </div>

            <div class='input-container'>
                <label for='pdf-template'>Certificate Template
                    <select name="pdf-template">
                        <option value='premortem-training'>Premortem Training</option>
                        <!-- <option value=''></option>
                        <option value=''></option> -->
                    </select>
                </label>
            </div>
        </form> 

        <script src="index.js"></script>
    </body>
</html>
