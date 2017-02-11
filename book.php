<?php

include "connection.php";


$bookName = $_GET['name'];
$sql = "SELECT * FROM books WHERE book_name ='$bookName' ";

$query = mysql_query($sql) or die(mysql_error());

?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv=Content-Type content=text/html; charset=utf-8>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>NFQ užduotis</title>
  </head>
  <body>
<div class="page-container">

  <div class="results">
    <ul class="book_list">
      <li class="table-header">
        <span>Knygos pavadinimas</span>
        <span>Autorius</span>
        <span>Žanras</span>
        <span class="release_date">Leidimo metai</span>
      </li>
    <?php while ($row = mysql_fetch_array($query)) { ?>
       <li>
         <span class="book_name"><?php echo  $row['book_name'] ?></span>
         <span class="author"><?php echo  $row['author'] ?></span>
         <span class="gener"><?php echo  $row['genre'] ?></span>
         <span class="release_date"><?php echo  $row['release_date'] ?></span>
       </li>
    <?php  }?>
    </ul>
  </div>
</div>

  </body>
</html>
