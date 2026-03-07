<?php

    $data = json_decode(file_get_contents("php://input"));
      $author->id = $data->id;
      
      // Check if author exists
      $author->read_single();
      if(empty($author->name)) {
        echo json_encode(
          array('message' => 'author_id not Found')
        );
        exit();
      }

      if($author->delete()) {
        echo json_encode(
          array('id' => $author->id)
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Deleted')
        );
      }
?>