<?php
      $data = json_decode(file_get_contents("php://input"));
      
      // Check for required parameters
      if(empty($data->author)) {
        echo json_encode(
          array('message' => 'Missing Required Parameters')
        );
        exit();
      }
      
      $author->name = $data->author;

      if($author->create()) {
        echo json_encode(
          array(
            'id' => $author->id,
            'author' => $author->name
          )
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Created')
        );
      }
?>