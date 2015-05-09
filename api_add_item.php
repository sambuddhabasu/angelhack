<?php
  $db = new SQLite3('database.db');
  $query = "SELECT * FROM ingredient;";
  $res = $db->query($query);
  $present = 0;
  while($row = $res->fetchArray()) {
    $present += 1;
  }
  for($i = 0; $i < count($_GET) / 2; $i += 1) {
    $present += 1;
    $check_existing = $db->query("SELECT * FROM ingredient WHERE name='".$_GET['name_'.$i]."';");
    $row = $check_existing->fetchArray();
    if($row) {
      $existing = floatval($row['quantity']);
      $added = floatval($_GET['quantity_'.$i]);
      $final = $existing + $added;
      $query_update = "UPDATE ingredient SET quantity='".$final."' WHERE name='".$_GET['name_'.$i]."';";
      $db->exec($query_update);
    }
    else {
      $photo = "";
      $name = $_GET['name_'.$i];
      if($name == "beef") {
        $photo = "beef.jpeg";
      }
      else if($name == "milk") {
        $photo = "milk.jpeg";
      }
      else if($name == "coke") {
        $photo = "coke.jpeg";
      }
      else if($name == "turkey") {
        $photo = "turkey.jpg";
      }
      else if($name == "cheese") {
        $photo = "cheese.jpeg";
      }
      $query = "INSERT INTO ingredient VALUES('".$present."', '".$_GET['name_'.$i]."', '".$_GET['quantity_'.$i]."', '', '".$photo."');";
      $db->exec($query);
    }
  }
  header('Location: my_fridge.php');
?>
