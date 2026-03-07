<?php

    $data = json_decode(file_get_contents("php://input"));
      $category->id = $data->id;
      
      // Check if category exists
      $category->read_single();
      if(empty($category->category)) {
        echo json_encode(
          array('message' => 'category_id not Found')
        );
        exit();
      }

      if($category->delete()) {
        echo json_encode(
          array('id' => $category->id)
        );
      } else {
        echo json_encode(
          array('message' => 'Category Not Deleted')
        );
      }
?>