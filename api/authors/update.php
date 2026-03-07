<?php
      $data = json_decode(file_get_contents("php://input"));
      
      // Check for required parameters
      if(empty($data->id) || empty($data->author)) {
        echo json_encode(
          array('message' => 'Missing Required Parameters')
        );
        exit();
      }
      
      $author->id = $data->id;
      $author->read_single();
      if(empty($author->name)) {
        echo json_encode(
          array('message' => 'author_id Not Found')
        );
        exit();
      }

      $author->name = $data->author;

      if($author->update()) {
        echo json_encode(
          array(
            'id' => $author->id,
            'author' => $author->name
          )
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Updated')
        );
      }
      ?>