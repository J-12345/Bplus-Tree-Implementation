<?php
require_once 'b+tree.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid1 = $_POST['uid'];
    $name = $_POST['name'];
    $speciality = $_POST['specialty'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $data = $uid1 . '|' . $name . '|' . $speciality . '|' . $email . '|' . $phone . PHP_EOL;
    $tree = new BPTree();
    $filename = "data.txt";
    $file = fopen($filename, "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $record = explode("|", $line);
            $uid = $record[0];
            if ($uid[0] !== '$')
                $tree->insert($uid);
        }
        fclose($file);
    } else {
        echo "Failed to open the file.";
    }
    $l=$tree->search($uid1,0);
    if($l===-1)
    {
    file_put_contents('data.txt', $data, FILE_APPEND | LOCK_EX);
    $tree->insert($uid1);
    }
    
}
?>
<html>
<head>
    <title>Doctor Records</title>
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
            if ($l === -1) {
                echo "Record Successfully Inserted";
            } else {
                echo "UID already present in the tree";
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
