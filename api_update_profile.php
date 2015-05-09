<?php
  $db = new SQLite3('database.db');
  if(is_uploaded_file($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name']) != false) {
  }
  $query = "UPDATE users SET first_name='" . $_GET['first_name'] . "', last_name='" . $_GET['last_name'] . "', email='" . $_GET['email'] . "', phone='".$_GET['phone']."' WHERE user_id=1;";
  $db->exec($query);
  header('Location: my_fridge.php');
?>
