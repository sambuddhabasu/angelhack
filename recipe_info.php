<?php
  $db = new SQLite3('database.db');
  $results = $db->query('SELECT * FROM recipe WHERE recipe_id='.$_GET["recipe_id"].';');
  $row = $results->fetchArray();
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
        <h1><?php echo $row['name']; ?></h1>
      </div>
        <div class="col-lg-6 col-lg-offset-3">
          <img src="<?php echo $row['photo']; ?>" width="512">
        </div>
        <div class="col-lg-6 col-lg-offset-3">
          <h2>Ingredients<h2>
        </div>
        <?php
          $ingredients = explode(',', $row['ingredient']);
          foreach($ingredients as $ingredient) {
            $ingredient = explode('#', $ingredient);
        ?>
            <div class="col-lg-6 col-lg-offset-3">
              <div class="col-lg-6">
                <h3><?php echo $ingredient[0]; ?></h3>
              </div>
              <div class="col-lg-6">
                <h3><?php echo $ingredient[1]; ?></h3>
              </div>
            </div>
        <?php
          }
        ?>
        <div class="col-lg-6 col-lg-offset-3">
          <h2>Instructions</h2>
          <p class="lead"><?php echo $row['instruction']; ?></p>
        </div>
        <div class="col-lg-6 col-lg-offset-3">
          <form action="checkout.php" method="GET">
            <h2><input type="text" value="" placeholder="Quantity" name="quantity" required></h2>
            <input type="hidden" name="recipe_id" value="<?php echo $_GET['recipe_id']; ?>">
            <button type="submit" class="btn btn-primary">Proceed To Checkout</button>
          </form>
        </div>
    </div>
  </body>
</html>
