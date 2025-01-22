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
                <input type='text' name='file-prefix' />
            </label>

            <label for='pdf-template' class="input-container">Certificate Template
                <select name="pdf-template">
                    <option value='default' disabled selected>Select A Template</option>
                    <option value='premortem-training'>Premortem Training</option>
                </select>
            </label>

            <label for="csv-upload" class="input-container">CSV Upload
                <input type="file" name="csv-upload" />
            </label>

        </form>

        <div id="config-controls">
            <button type="button" class="button button-primary" id="config-submit">Generate</button>
        </div>

        <a href="" id="csv-download" class="copy">Download CSV Template Here</a>

        <script src="index.js"></script>
    </body>
</html>
