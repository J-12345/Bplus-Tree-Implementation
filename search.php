<?php
require_once 'b+tree.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid1 = $_POST['uid'];
$tree = new BPTree();
$filename = "data.txt";
$file = fopen($filename, "r");
$x=0;
if ($file) {
    while (($line = fgets($file)) !== false) {
        $record = explode("|", $line);
        $uid = $record[0];
        if ($uid[0] !== '$')
        $tree->insert($uid);
        if($uid1===$uid)
        {
            $x=1;
            $name=$record[1];
            $speciality=$record[2];
            $email=$record[3];
            $phone=$record[4];
        }
    }
    fclose($file);
} else {
    echo "Failed to open the file.";
}
$l=$tree->search($uid1);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Records</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
<style>
  body {
      font-family: Arial, sans-serif;
      background-color: #EAF2F8;
    background-size: cover;
      margin: 0;
  }

  h2 {
    margin-top: 10%;
      text-align: center;
  }

  form {
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 4px;
      padding: 10px;
      max-width: 400px;
      margin: 3% auto;
  }

  label {
      display: block;
      margin-bottom: 2px;
      font-weight: bold;
  }

  input[type="text"],
  input[type="email"] {
      width: 100%;
      padding: 3px;
      border: 1px solid #cccccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 15px;
  }

  input[type="submit"] {
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      padding: 3px 20px;
      border-radius: 4px;
      cursor: pointer;
  }

  input[type="submit"]:hover {
      background-color: #45a049;
  }
</style>
</style>
<style>
        table {
            margin-top: 10%;
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        
        th, td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }
        
        th {
            background-color: gray;
            color: white;
            font-weight: bold;
        }
        td{
            background-color: white;
            color: black;
            font-style:center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Doctor Record Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" sty="text-align:right">
              <a class="nav-link" href="add.html">Insert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.html">Search</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="delete.html">Remove</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="display.php">B+Tree</a>
              </li>
        </div>
      </nav>
  <div>
  <table>
        <tr>
            <th>UID</th>
            <th>Name</th>
            <th>Speciality</th>
            <th>Email</th>
            <th>Phone no</th>
        </tr>
        <?php if ($l>-1) {?>
        <tr>
            <td><?php echo $uid1 ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $speciality ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $phone ?></td>

        </tr> 
        <tr>
            <td colspan="5" ><h6><?php echo "Found at Level $l" ?></h6></td>
    </tr>
    <?php } else {?>
        <tr>
            <td colspan="5" ><h6><?php echo "UID Not Found" ?></h6></td>
    </tr>
    <?php } ?>
  </table>   
  </div>
    
</body>
</html>