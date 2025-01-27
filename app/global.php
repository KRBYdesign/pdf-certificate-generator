<?php

function errorReporting() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Global functions and such

/**
 * Returns the contents of a given file after replacing the given search keys with their corresponding values.
 *
 * @param string $filepath
 * @param array $replacements
 * @return string
 * @throws Exception
 */
function includeAndReplaceContents(string $filepath, array $replacements = []) : string
{
    // get the file contents
    if (!$fileContents = file_get_contents($filepath)) {
        throw new \Exception("File {$filepath} not found");
    }

    //
    foreach ($replacements as $key => $value) {
        $fileContents = str_replace("{{ $key }}", $value, $fileContents);
    }

    return $fileContents;
}

/**
 *
 *
 * @param string $filePath
 * @return array
 * @throws Exception
 */
function getNamesFromCSV(string $filePath) : array
{
    $names = array();

    // open the file for reading
    if (($handle = fopen($filePath, "r")) !== false) {
        $header = fgetcsv($handle); // get the first row aka the headers

        // validate the header structure
        $expectedHeaders = ['First Name', 'Last Name'];
        if ($header !== $expectedHeaders) {
            echo "Invalid CSV Header";
            fclose($handle);

            throw new \Exception("Invalid CSV Header");
        }

        // process the reset of the rows
        while (($row = fgetcsv($handle)) !== false) {
            $firstName = $row[0];
            $lastName = $row[1];

            if (empty($firstName) || empty($lastName)) {
                echo "Invalid CSV Row";
                continue;
            }

            // combine the name fields and add them to the names array
            $names[] = ucfirst($firstName) . ' ' . ucfirst($lastName);
        }

        // close the csv
        fclose($handle);
    }

    return $names;
}
