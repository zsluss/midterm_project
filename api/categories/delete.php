<?php

    $data = json_decode(file_get_contents("php://input"));
      $category->id = $data->id;

      if($category->delete()) {
        echo json_encode(
          array('message' => 'Category Deleted')
        );
      } else {
        echo json_encode(
          array('message' => 'Category Not Deleted')
        );
      }
?>
?>