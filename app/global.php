<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
