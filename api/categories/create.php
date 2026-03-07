<?php
      $data = json_decode(file_get_contents("php://input"));
      
      // Check for required parameters
      if(empty($data->category)) {
        echo json_encode(
          array('message' => 'Missing Required Parameters')
        );
        exit();
      }
      
      $category->category = $data->category;

      if($category->create()) {
        echo json_encode(
          array(
            'id' => $category->id,
            'category' => $category->category
          )
        );
      } else {
        echo json_encode(
          array('message' => 'Category Not Created')
        );
      }
?>