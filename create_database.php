<?php
  $db = new SQLite3('database.db');

  $db->exec("CREATE TABLE users(user_id INTEGER, first_name VARCHAR(25), last_name VARCHAR(25), email VARCHAR(25), phone VARCHAR(25));");
  $db->exec("INSERT INTO users VALUES(1, 'Sambuddha', 'Basu', 'sambuddhabasu1@gmail.com', '0500000000');");

  $db->exec("CREATE TABLE recipe(recipe_id INTEGER, name VARCHAR(25), time VARCHAR(50), cuisine VARCHAR(100), ingredient VARCHAR(500), instruction VARCHAR(500), photo VARCHAR(500));");
  $db->exec("INSERT INTO recipe VALUES(1, 'Chicken Fajita', 'breakfast,lunch,dinner,snacks', 'american', 'white meat chicken#1.5 pound,onion#1,bell pepper#3', 'Chicken breasts come in different sizes. If you have chicken breasts that are around a half pound each or more, you will want to slice them in half horizontally, so that the center thickness is around 1/2-inch to 3/4-inch thick. Mix all the marinade ingredients together in a glass or plastic container. Add the chicken, mix well, cover and let marinate at room temperature for 1 hour. Remove the chicken from the marinade. Wipe off most of the marinade and sprinkle the chicken pieces with salt.', 'chicken_fajita.jpg');");
  $db->exec("INSERT INTO recipe VALUES(2, 'Chicken Burger', 'breakfast,lunch,dinner,snacks', 'american', 'white meat chicken#1 pound,fresh bread crumbs#200 gm,low-fat milk#0.5 cup', 'Lightly spray a saute pan with cooking or oil spray over medium heat. Saute the onion with the garlic first, then the bell pepper, then the mushrooms, tomatoes and carrots, all to desired tenderness. Set aside and allow all vegetables to cool completely. In a large bowl, combine the chicken and vegetables. Add the egg, bread crumbs and seasonings to taste. Mix all together well and form into 8 patties.', 'http://www.texaschicken.com.sg/menu/breakfast-classic-chicken-burger.png');");
  $db->exec("INSERT INTO recipe VALUES(3, 'Chicken Meat', 'lunch,dinner', 'american', 'white meat chicken#0.5 pound', 'Lightly spray a saute pan with cooking or oil spray over medium heat.', 'http://www.caferio.com/uploads/images/home/1351808642_1.jpg');");

  $db->exec("CREATE TABLE ingredient(ingredient_id INTEGER, name VARCHAR(100), quantity VARCHAR(100), unit VARCHAR(100), photo VARCHAR(500));");
  $db->exec("INSERT INTO ingredient VALUES(1, 'white meat chicken', '2', 'pound', 'chicken.jpg')");
  $db->exec("INSERT INTO ingredient VALUES(2, 'fresh bread crumbs', '500', 'gm', 'bread.jpg');");

  $db->exec("CREATE TABLE time(name VARCHAR(50));");
  $db->exec("INSERT INTO time VALUES('breakfast');");
  $db->exec("INSERT INTO time VALUES('lunch');");
  $db->exec("INSERT INTO time VALUES('dinner');");
  $db->exec("INSERT INTO time VALUES('snacks');");

  $db->exec("CREATE TABLE cuisine(name VARCHAR(50));");
  $db->exec("INSERT INTO cuisine VALUES('american');");
  $db->exec("INSERT INTO cuisine VALUES('chinese');");
  $db->exec("INSERT INTO cuisine VALUES('indian');");
  $db->exec("INSERT INTO cuisine VALUES('japanese');");
  $db->exec("INSERT INTO cuisine VALUES('lebanese');");

  $db->exec("CREATE TABLE fav(recipe_id INTEGER);");
  $db->exec("INSERT INTO fav VALUES(1);");
?>
