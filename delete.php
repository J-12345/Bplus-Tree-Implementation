<?php
require_once 'b+tree.php';

$x = 0; // Initialize $x outside the if statement

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid1 = $_POST['uid'];
    $tree = new BPTree();
    $filename = "data.txt";

    $lines = file($filename, FILE_IGNORE_NEW_LINES); // Read the file content into an array

    if ($lines) {
        foreach ($lines as &$line) {
            $record = explode("|", $line);
            $uid = $record[0];

            if ($uid1 === $uid) {
                $x = 1;
                $line = str_replace($uid, "$".$uid, $line);
            } else if ($uid[0] !== '$') {
                $tree->insert($uid);
            }
        }

        // Write the modified content back to the file
        file_put_contents($filename, implode("\n", $lines));
    } else {
        echo "Failed to open the file.";
    }
} else {
    echo "Hi";
}
?>
<html>
<head>
    <title>Popup Message Example</title>
    <style>
        /* Styles for the popup container */
        .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        
        /* Styles for the popup box */
        .popup-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        
        /* Styles for the button */
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="popup-container" id="popupContainer">
        <div class="popup-box">
            <?php
            if ($x === 1) {
                echo "Record Successfully Deleted";
            } else {
                echo "UID not found in the tree";
            }
            ?>
            <a class="button" href="display.php">B+Tree</a>
            <a class="button" href="index.html">Home</a>
        </div>
    </div>

    <script>
        // JavaScript code to show the popup container
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('popupContainer').style.display = 'flex';
        });
    </script>
</body>
</html>
