<?php

    $data = json_decode(file_get_contents("php://input"));
      $author->id = $data->id;

      if($author->delete()) {
        echo json_encode(
          array('message' => 'Author Deleted')
        );
      } else {
        echo json_encode(
          array('message' => 'Author Not Deleted')
        );
      }
?>
?>