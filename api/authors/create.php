<?php
      $data = json_decode(file_get_contents("php://input"));
      $author->name = $data->author;

      if($author->create()) {
        echo json_encode(
          array('message' => 'Author Created')
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Created')
        );
      }
?>