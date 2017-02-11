<?php

include "connection.php";


$results_per_page = 10;

$sql = "SELECT * FROM books ";

$query = mysql_query($sql) or die(mysql_error());
$number_of_result = mysql_num_rows($query);
$number_of_pages = ceil($number_of_result/$results_per_page);


if(isset($_GET['search'])){

$search_term = mysql_real_escape_string($_GET['request']);

}

if(!isset($_GET['page'])){
  $page = 1;
}else {
  $page = $_GET['page'];
}


$page_result = ($page-1)*$results_per_page;




$sql = "SELECT * FROM books
        WHERE book_name LIKE '%$search_term%'
        OR author LIKE '%$search_term%'
        OR genre LIKE '%$search_term%'

        " ;

        if(isset($_GET['sort'])){

        $sort = mysql_real_escape_string($_GET['sorting_by']);
        $sql .= " ORDER BY $sort";

      }else {
          $sql .= " ORDER BY book_name ASC";
      }


      $sql .= " LIMIT  $page_result,$results_per_page";

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
      <div class="search-container">

        <form class="sort_form" name="sort_form" action="">
          <label>Rūšiuoti pagal:</label>
          <select id="sorting_by" name="sorting_by">
            <option value="book_name" ></option>
            <option value="book_name" >Knygos pavadinimą</option>
            <option value="author">Autorių</option>
            <option value="genre">Žanrą</option>
            <option value="release_date DESC">Naujausios</option>
          </select>
          <input id="sort" type="submit" name="sort" value="Rūšiuoti">

        </form>
        <form name="search_form" action="" method="">
          <input type="text" name="request" placeholder="Knygos paieška" value="<?php echo $search_term ?>">
          <input type="submit" name="search" value="Ieškoti">
        </form>
      </div>
      <div class="results">
        <ul class="book_list">
          <li class="table-header">
            <span class="book_name" >Knygos pavadinimas</span>
            <span class="author">Autorius</span>
            <span class="gener">Žanras</span>
            <span class="release_date">Leidimo metai</span>
          </li>
          <?php while ($row = mysql_fetch_array($query)) { ?>
           <li>
             <span class="book_name"><a class="link" href="book.php?name=<?php echo  $row['book_name'] ?>"><?php echo  $row['book_name'] ?></a></span>
             <span class="author"><?php echo  $row['author'] ?></span>
             <span class="gener"><?php echo  $row['genre'] ?></span>
             <span class="release_date"><?php echo  $row['release_date'] ?></span>
           </li>
          <?php }?>
        </ul>
        <div class="pagination">
          <?php for($page=1;$page<=$number_of_pages;$page++){
                echo '<a href="?page=' . $page . '">' . $page . '</a>';
                }?>
        </div>
      </div>
    </div>

  </body>
</html>
