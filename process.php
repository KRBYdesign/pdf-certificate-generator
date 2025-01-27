<?php

require_once 'vendor/autoload.php';

use App\HtmlTemplate;

// turn on error reporting
errorReporting();

// redirect back to the form if the request method isn't a post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ./index.php");
}

// check the honeypot
if (isset($_POST['preferred-name'])) {
    header('HTTP/1.1 403 Forbidden');
    die("Forbidden");
}

// get the file prefix and the chosen template
$filePrefix = $_POST['file-prefix'];
$selectedTemplate = $_POST['pdf-template'];
$certificateRecipients = array();

// get the csv upload
if (isset($_FILES['csv-upload']) && $_FILES['csv-upload']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csv-upload']['tmp_name'];
    $fileName = $_FILES['csv-upload']['name'];
    $fileSize = $_FILES['csv-upload']['size'];
    $fileType = $_FILES['csv-upload']['type'];

    // validate the file type
    $allowedFileType = 'text/csv';
    $allowedExtensions = ['csv'];

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if ($fileType === $allowedFileType && in_array($fileExtension, $allowedExtensions)) {
        try {
            $certificateRecipients = getNamesFromCSV($fileTmpPath);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            die($e->getMessage());
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        die("Invalid file. Please upload a csv file.");
    }
} else {
    header('HTTP/1.1 500 Internal Server Error');
    die("<p>Error uploading CSV</p><br /><a href='./index.php'>Go Back</a>");
}

// use the selected template to get the rest of the provided information
$dataContents = file_get_contents("./storage/data/$selectedTemplate.json", true);

if ($dataContents) {
    $generationData = json_decode($dataContents, true);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    die("Error while retrieving PDF generation data.");
}

// generate associative array for the optionalFields fields
$optionalFields = array();
foreach($generationData['fields'] as $field) {
    $optionalFields[$field] = $_POST[$field];
}

// generate the HTML for each page in the PDF
$generatedCertificates = array();
if (count($certificateRecipients) > 0) {
    foreach ($certificateRecipients as $recipient) {
        $generatedCertificates[] = new HtmlTemplate($recipient, $optionalFields, $selectedTemplate);
    }
} else {
    header('HTTP/1.1 500 Internal Server Error');
    die("No certificate recipients could be found");
}

// generate the multi-page PDF