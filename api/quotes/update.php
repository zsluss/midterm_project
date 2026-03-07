<?php
      $data = json_decode(file_get_contents("php://input"));
      
      // Check for required parameters
      if(empty($data->id) || empty($data->quote) || empty($data->author_id) || empty($data->category_id)) {
        echo json_encode(
          array('message' => 'Missing Required Parameters')
        );
        exit();
      }

      // Check if author_id exists
      $author->id = $data->author_id;
      $author->read_single();
      if(empty($author->name)) {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
        exit();
      }

      // Check if category_id exists
      $category->id = $data->category_id;
      $category->read_single();
      if(empty($category->category)) {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
        exit();
      }

      // Check if quote exists
      $quote->id = $data->id;
      $quote->read_single();
      if(empty($quote->quote)) {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
        exit();
      }

      $quote->quote = $data->quote;
      $quote->author_id = $data->author_id;
      $quote->category_id = $data->category_id;

      if($quote->update()) {
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
          array('message' => 'Quote Not Updated')
        );
      }
      ?>