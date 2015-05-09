<?php
  $db = new SQLite3('database.db');
  $query = "INSERT INTO fav VALUES(".$_GET['recipe_id'].")";
  $db->exec($query);
  header('Location: my_fridge.php');
?>
