<?php
      $category->id = $_GET['id'];
      $category->read_single();
      
      if(empty($category->category)) {
        echo json_encode(
          array('message' => 'category_id Not Found')
        );
      } else {
        echo json_encode(array(
          'id' => $category->id,
          'category' => $category->category
        ));
      }
?>