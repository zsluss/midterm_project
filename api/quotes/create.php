<?php
      $data = json_decode(file_get_contents("php://input"));
      
      // Check for required parameters
      if(empty($data->quote) || empty($data->author_id) || empty($data->category_id)) {
        echo json_encode(
          array('message' => 'Missing required parameters')
        );
        exit();
      }

      // Check if author_id exists
      $author->id = $data->author_id;
      $author->read_single();
      if(empty($author->name)) {
        echo json_encode(
          array('message' => 'author_id not found')
        );
        exit();
      }

      // Check if category_id exists
      $category->id = $data->category_id;
      $category->read_single();
      if(empty($category->category)) {
        echo json_encode(
          array('message' => 'category_id not found')
        );
        exit();
      }

      $quote->quote = $data->quote;
      $quote->author_id = $data->author_id;
      $quote->category_id = $data->category_id;

      if($quote->create()) {
        echo json_encode(
          array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
          )
        );
      } else {
        echo json_encode(
          array('message' => 'Quote Not Created')
        );
      }
?>