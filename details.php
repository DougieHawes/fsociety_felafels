<?php

  include('config/db_connect.php');

  if(isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($connection, $_POST['id_to_delete']);

    $sql = "DELETE FROM felafels WHERE id = $id_to_delete";

    if (mysqli_query($connection, $sql)) {
      header('Location: index.php');
    } else {
      echo 'query error: '.mysqli_error($connection);
    }
  };

  if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM  felafels WHERE id = $id";

    $result = mysqli_query($connection, $sql);

    $felafel = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($connection);
  };

?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php'); ?>
    <div class="route felafel-page">
      <?php if($felafel): ?>
        <h3><?php echo htmlspecialchars($felafel['name']); ?></h3>
        <p>created by: <?php echo htmlspecialchars($felafel['email']) ?></p>
        <p>created on: <?php echo htmlspecialchars($felafel['created_at']) ?></p>
        <h4>ingredients</h4>
        <p><?php echo htmlspecialchars($felafel['ingredients']) ?></p>

        <form action="details.php" method="POST">
          <input type='hidden' name="id_to_delete" value="<?php echo $felafel['id'] ?>">
          <input type='submit' name="delete" value='DELETE'>
        </form>
      <?php else: ?>
        <h3>unknown felafel</h3>
      <?php endif; ?>
    </div>
  <?php include('templates/footer.php'); ?>
</html>
