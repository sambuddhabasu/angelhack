<?php
  if(isset($_GET['recipe_name'])) {
    $db = new SQLite3('database.db');
    $results = $db->query('SELECT * FROM recipe WHERE name LIKE "%'.$_GET['recipe_name'].'%";');
    $favs_results = $db->query('SELECT * FROM fav;');
    $favs = array();
    while($row = $favs_results->fetchArray()) {
      array_push($favs, $row[0]);
    }
  }
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
        <h1>Search Recipe</h1>
      </div>
        <div class="col-lg-6 col-lg-offset-3">
          <form action="search_recipe.php" method="GET">
            <h2><input type="text" value="<?php echo $_GET['recipe_name']; ?>" placeholder="Recipe name" name="recipe_name" required></h2>
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </div>
        <?php
          if(isset($_GET['recipe_name'])) {
            while($row = $results->fetchArray()) {
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
                <?php
                  if(!in_array($row['recipe_id'], $favs)) {
                ?>
                    <a href="api_add_fav_recipe.php?recipe_id=<?php echo $row['recipe_id']; ?>">
                      <img src="https://cdn2.iconfinder.com/data/icons/windows-8-metro-style/512/plus-.png" width="64">
                    </a>
                <?php
                  }
                ?>
                </div>
              </div>
        <?php
            }
          }
        ?>
    </div>
  </body>
</html>
