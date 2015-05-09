<?php
  $db = new SQLite3('database.db');
  $query = "DELETE FROM fav WHERE recipe_id='".$_GET['recipe_id']."';";
  $db->exec($query);
  header('Location: my_fridge.php');
?>
