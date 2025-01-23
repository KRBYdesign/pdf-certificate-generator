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

            <label for="preferred-name" class="input-catch">
                <input type="text" name="preferred-name" autocomplete="nope"/>
            </label>

            <label for='file-prefix' class="input-container">File Prefix
                <input type='text' name='file-prefix' autocomplete="nope" placeholder="file_prefix_...csv"/>
            </label>

            <label for="csv-upload" class="input-container">CSV Upload
                <input type="file" name="csv-upload" accept="text/csv, .csv"/>
            </label>

            <label for='pdf-template' class="input-container">Certificate Template
                <select name="pdf-template">
                    <option value='default' disabled selected>Select A Template</option>
                    <option value='cert-of-completion'>Certificate of Completion</option>
                </select>
            </label>

            <!-- Optional / Hidden Fields -->

            <label for=""

        </form>

        <div id="config-controls">
            <button type="button" class="button button-primary" id="config-submit">Generate</button>
            <button type="button" class="button button-secondary" id="config-reset">Reset</button>
        </div>

        <a href="./storage/templates/certificate-csv-template.csv" id="csv-download" target="_blank" download>Download CSV Template Here</a>

        <script src="index.js"></script>
    </body>
</html>
