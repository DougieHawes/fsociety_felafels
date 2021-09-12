<?php

  include('config/db_connect.php');

  $email = $name = $ingredients = '';
  $errors = array('email' => '', 'name' => '', 'ingredients' => '');

  if(isset($_POST['submit'])) {
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "valid email is required<br />";
    } else {
      $email = $_POST['email'];
    }
    if (empty($_POST['name']) || !preg_match('/^[a-zA-Z]+$/', $_POST['name'])) {
      $errors['name'] = "name is required; no numbers, spaces, or symbols<br />";
    } else {
      $name = $_POST['name'];
    }
    if (empty($_POST['ingredients']) || !preg_match('/^([a-zA-Z\s]+)(,\s[a-zA-Z\s]*)*$/', $_POST['ingredients'])) {
      $errors['ingredients'] = "ingredients are required; with commas between each ingredient<br />";
    } else {
      $ingredients = $_POST['ingredients'];
    };

    if (array_filter($errors)) {

    } else {
      $name = mysqli_real_escape_string($connection, $_POST['name']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);

      $sql = "INSERT INTO felafels (name, email, ingredients) VALUES ('$name', '$email', '$ingredients')";

      if(mysqli_query($connection, $sql)) {
        header('Location: index.php');
      } else {
        echo 'query error: '.mysqli_error($connection);
      };
    };
  };

?>

<!DOCTYPE html>
<html>
    <?php include 'templates/header.php' ?>
    <div class="route">
      <form class="form" action="add.php" method="POST">
        <h2 class="form-title">add felafel</h2>
        <label class="form-label">email: </label>
        <input class="form-input" type="text" name="email" value="<?php echo $email ?>">
        <div class='error'><?php echo $errors['email'] ?></div>
        <label class="form-label">felafel name: </label>
        <input class="form-input" type="text" name="name" value="<?php echo $name ?>">
        <div class='error'><?php echo $errors['name'] ?></div>
        <label class="form-label">ingredients: (separated by a comma)</label>
        <input class="form-input" type="text" name="ingredients" value="<?php echo $ingredients ?>">
        <div class='error'><?php echo $errors['ingredients'] ?></div>
        <button class="form-button" name='submit' type='submit'>submit</button>
      </form>
    </div>
    <?php include 'templates/footer.php' ?>
</html>
