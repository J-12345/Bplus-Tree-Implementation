<?php
require_once 'b+tree.php';
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
global $arr;
$arr=array(array());
$tree->display($tree->getRoot(),0,$arr);
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
  .container {
    
    text-align: center;
    margin-top: 200px;
  }

  .button {
    padding: 10px 20px;
    margin: 10px;
    font-size: 18px;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
  }
  h2{
    padding: 5%;
    text-align: center;
  }
</style>
<style>
    .bplus-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .level {
        margin-bottom: 10px;
        display: inline-block;
        padding: 5px;
        background-color: #ffffff;
        border: 1px solid gray;
        margin-right: 5px;
    }

    .level-label {
      display: inline-block;
        font-weight: bold;
    }

    .key {
        
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
  <div class="container">
    <?php
    $c=[];
  echo "<div class='bplus-tree'>\n";
foreach ($arr as $level => $keys) {
    echo "<div class='level'>\n";
    echo "<span class='level-label'>Level $level:</span>\n";
    if($level>0)
    {
      $r=1;
      $k=0;
      if($level>1)
      {
      foreach($arr[$level-1] as $o)
      {
      array_push($c,$o);
      }
    }
    }
    else{
      $c=$keys;
    }
    $e=-1;
    foreach ($keys as $key) {
      if($r===1)
      {
        sort($c);
          $q= $c[$k];
          if($level===count($arr)-1 )
          $e++;
          if($key>=$q || $e===3)
          {
            if($key>=$q)
            $k++;
            if($e===3)
            $e=0;
          if($level===count($arr)-1 )
          {
            if($k!==count($c))
            echo "<span class='key'>-></span>\n";
            $e=0;
          }
          else
          {
            if($k-1!==count($c))
            echo "<span class='key'>||</span>\n";
          }
        }
      }
        echo "<span class='key'>$key </span>\n";
    }
    echo "</div>\n";
  }
  echo "</div>\n";
    ?>
    
  </div>
  <div>
    <h2>B+ Tree</h2>

</div>
</body>
</html>
