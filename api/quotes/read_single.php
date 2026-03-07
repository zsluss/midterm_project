<?php
      $quote->id = $_GET['id'];
      $quote->read_single();
      
      if(empty($quote->quote)) {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
      } else {
        echo json_encode(array(
          'id' => $quote->id,
          'quote' => $quote->quote,
          'author_id' => $quote->author_id,
          'category_id' => $quote->category_id
        ));
      }
?>