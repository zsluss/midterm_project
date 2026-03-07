<?php
      $data = json_decode(file_get_contents("php://input"));
      $category->id = $data->id;
      $category->read_single();
      if(empty($category->category)) {
        echo json_encode(
          array('message' => 'category_id Not Found')
        );
        exit();
      }

      $category->category = $data->category;

      if($category->update()) {
        echo json_encode(
          array(
            'id' => $category->id,
            'category' => $category->category
          )
        );
      } else {
        echo json_encode(
          array('message' => 'Category Not Updated')
        );
      }
      ?>