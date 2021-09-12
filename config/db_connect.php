<?php

  // connection
  $connection = mysqli_connect('localhost', 'doug', 'Rodin42', 'fun_society_felafels');

  if (!$connection) {
    echo 'connection error: ' . mysqli_connect_error();
  };

?>
