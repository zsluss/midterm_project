<?php
      $category->id = $_GET['id'];
      $category->read_single();
      echo json_encode(array(
        'id' => $category->id,
        'category' => $category->category
      ));
?>