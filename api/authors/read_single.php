<?php
      $author->id = $_GET['id'];
      $author->read_single();
      
      if(empty($author->author)) {
        echo json_encode(
          array('message' => 'author_id Not Found')
        );
      } else {
        echo json_encode(array(
          'id' => $author->id,
          'author' => $author->author
        ));
      }
?>