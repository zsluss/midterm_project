<?php
      $author->id = $_GET['id'];
      $author->read_single();
      echo json_encode(array(
        'id' => $author->id,
        'name' => $author->name
      ));
?>