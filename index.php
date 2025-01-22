<?php



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Certificate Generator</title>
        <link rel="stylesheet" href="./main.css">
    </head>
    <body>
        <form action='./process.php' method="post">
            <div class='input-container'>
                <label for='file-prefix'>File Prefix</label>
                <input type='text' name='file-prefix' required />
            </div>

            <div class='input-container'>
                <label for='pdf-template'>File Prefix</label>

                <select>
                    <option value='premortem-training'>Premortem Training</option>
                    <!-- <option value=''></option>
                    <option value=''></option> -->
                </select>
            </div>
        </form> 

        <script src="index.js"></script>
    </body>
</html>
