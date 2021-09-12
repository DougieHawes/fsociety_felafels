<?php

  include('config/db_connect.php');

  // all felafels
  $sql = "SELECT name, ingredients, id FROM felafels ORDER BY created_at";

  $result = mysqli_query($connection, $sql);

  $felafels = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  mysqli_close($connection);

?>

<!DOCTYPE html>
<html>
    <?php include 'templates/header.php' ?>
    <div class="route">
      <h2 class="route-title">felafels</h2>

      <div class="table">
        <?php foreach ($felafels as $felafel): ?>
          <div class="table-item">
            <h3 class="table-item-title"><?php echo htmlspecialchars($felafel['name']); ?></h3>
            <ul class="table-item-ingredients">
              <?php foreach (explode(',', $felafel['ingredients']) as $ingredient): ?>
                <li class="table-item-ingredient">
                  <?php echo htmlspecialchars($ingredient); ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <a class="table-item-link" href="details.php?id=<?php echo $felafel['id'] ?>">more info</a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php include 'templates/footer.php' ?>
</html>
