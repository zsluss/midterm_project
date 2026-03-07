<?php
      $data = json_decode(file_get_contents("php://input"));
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
          array('message' => 'Author Updated')
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Updated')
        );
      }
      ?>