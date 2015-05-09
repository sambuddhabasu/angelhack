<?php
  $db = new SQLite3('database.db');
  $query = "DELETE FROM ingredient WHERE ingredient_id='".$_GET['ingredient_id']."';";
  $db->exec($query);
  header('Location: my_fridge.php');
?>
