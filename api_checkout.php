<?php
  $db = new SQLite3('database.db');
  $query = "SELECT * FROM ingredient;";
  $present = 0;
  $res = $db->query($query);
  while($row = $res->fetchArray()) {
    $present += 1;
  }
  $names = array();
  for($i = 0; $i < count($_GET) / 4; $i += 1) {
    $name = $_GET['name_'.$i];
    array_push($names, $name);
    $have = floatval($_GET['have_'.$i]);
    $need = floatval($_GET['need_'.$i]);
    $to_buy = floatval($_GET['quantity_'.$i]);
    $final = $have - $need + $to_buy;
    $query_exist = "SELECT * FROM ingredient WHERE name='".$name."';";
    $query_res = $db->query($query_exist);
    $row = $query_res->fetchArray();
    if($row) {
      $query = "UPDATE ingredient SET quantity='".$final."' WHERE name='".$name."';";
      $db->exec($query);
    }
    else {
      $present += 1;
      $total = $to_buy - $need;
      $photo = "";
      if($name == "onion") {
        $photo = "onion.jpeg";
      }
      else if($name == "bell pepper") {
        $photo = "bell_pepper.jpg";
      }
      else if($name == "low-fat milk") {
        $photo = "milk.jpeg";
      }
      $query = "INSERT INTO ingredient VALUES('".$present."', '".$name."', '".$total."', '', '".$photo."');";
      $db->exec($query);
    }
  }
  header('Location: my_fridge.php?names='.implode(',', $names));
?>
