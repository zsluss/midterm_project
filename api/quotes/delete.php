<?php

    $data = json_decode(file_get_contents("php://input"));
      $quote->id = $data->id;
      
      // Check if quote exists
      $quote->read_single();
      if(empty($quote->quote)) {
        echo json_encode(
          array('message' => 'quote_id not Found')
        );
        exit();
      }

      if($quote->delete()) {
        echo json_encode(
          array('id' => $quote->id)
        );
      } else {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
      }
?>