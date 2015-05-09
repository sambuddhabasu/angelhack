<?php
  $db = new SQLite3('database.db');
  $results = $db->query('SELECT * FROM fav;');
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
        <h1>Favourite Recipe</h1>
      </div>
      <?php
        while($result = $results->fetchArray()) {
          $row_response = $db->query('SELECT * from recipe WHERE recipe_id='.$result['recipe_id'].'');
          $row = $row_response->fetchArray();
      ?>
          <div class="col-lg-6 col-lg-offset-3">
            <hr>
            <a href="recipe_info.php?recipe_id=<?php echo $row['recipe_id']; ?>">
            <div class="col-lg-6">
              <img src="<?php echo $row['photo']; ?>" width="256">
            </div>
            <div class="col-lg-6">
              <h1><?php echo ucwords($row['name']); ?></h1>
              </a>
              <a href="api_delete_fav_recipe.php?recipe_id=<?php echo $row['recipe_id']; ?>">
                <img src="https://cdn3.iconfinder.com/data/icons/iconic-1/32/minus_alt-512.png" width="64">
              </a>
            </div>
          </div>
      <?php
        }
      ?>
    </div>
  </body>
</html>
