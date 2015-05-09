<?php
  $db = new SQLite3('database.db');
  $ingredients_final = array();
  $my_ingredients = $db->query('SELECT * from ingredient');
  while($row = $my_ingredients->fetchArray()) {
    $temp_arr = array();
    $temp_arr['quantity'] = $row['quantity'];
    $temp_arr['name'] = $row['name'];
    array_push($ingredients_final, $temp_arr);
  }
  $results = $db->query('SELECT * FROM recipe WHERE recipe_id='.$_GET['recipe_id'].';');
  $final_res = array();
  $row = $results->fetchArray();
  $ingredients_res = $row['ingredient'];
  $ingredients_response = explode(',', $ingredients_res);
  foreach($ingredients_response as $ingredient) {
    $ingredient_temp = explode('#', $ingredient);
    $temp_arr = array();
    $temp_arr['name'] = $ingredient_temp[0];
    $temp_arr['quantity'] = explode(' ', $ingredient_temp[1])[0] * $_GET['quantity'];
    $temp_arr['unit'] = explode(' ', $ingredient_temp[1])[1];
    array_push($final_res, $temp_arr);
  }
//  print_r($final_res);
//  print_r($ingredients_final);
  $need_arr = $final_res;
  $have_arr = array();
  foreach($need_arr as $temp_needed) {
//    echo $temp_needed['name'] . $temp_needed['quantity'];
    $valid = false;
    foreach($ingredients_final as $temp_have) {
      if($temp_needed['name'] == $temp_have['name']) {
        $valid = true;
        array_push($have_arr, $temp_have['quantity']);
        break;
      }
    }
    if(!$valid) {
      array_push($have_arr, 0);
    }
  }
//  print_r($need_arr);
//  print_r($have_arr);
?>
<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
  </head>
  <body>
    <?php
      include_once('header.php');
    ?>
    <div class="container">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Checkout</h1>
      </div>
      <form action="api_checkout.php">
      <?php
        for($i = 0; $i < count($need_arr); $i += 1) {
      ?>
          <div class="col-lg-6 col-lg-offset-3">
            <hr>
            <div class="col-lg-6">
              <h2><?php echo ucwords($need_arr[$i]['name']); ?></h2>
              <?php
                $name = $need_arr[$i]['name'];
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
                else if($name == "white meat chicken") {
                  $photo = "chicken.jpg";
                }
                else if($name == "fresh bread crumbs") {
                  $photo = "bread.jpg";
                }
              ?>
              <img src="<?php echo $photo; ?>" width="256">
            </div>
            <div class="col-lg-6">
              <h3>Needed: <?php echo $need_arr[$i]['quantity']; ?></h3>
              <h3>Have: <?php echo $have_arr[$i]; ?></h3>
              <?php
                $check_negative = floatval($need_arr[$i]['quantity']) - floatval($have_arr[$i]);
                if($check_negative < 0) {
                  $check_negative = 0;
                }
              ?>
                <h3>Extra to order: <input type="text" value="<?php echo $check_negative; ?>" name="quantity_<?php echo $i; ?>"></h3>
                <input type="hidden" value="<?php echo $have_arr[$i]; ?>" name="have_<?php echo $i; ?>">
                <input type="hidden" value="<?php echo $need_arr[$i]['quantity']; ?>" name="need_<?php echo $i; ?>">
                <input type="hidden" value="<?php echo $need_arr[$i]['name']; ?>" name="name_<?php echo $i; ?>">
              <h4><?php echo $need_arr[$i]['unit']; ?></h4>
            </div>
          </div>
      <?php
        }
      ?>
      <div class="col-lg-6 col-lg-offset-3">
        <button type="submit" class="btn btn-primary">Buy from ASDA</button>
        <button type="submit" class="btn btn-primary">Buy from InstaCart</button>
        <button type="submit" class="btn btn-primary">Buy from Carrefour</button>
      </div>
      </form>
    </div>
  </body>
</html>
