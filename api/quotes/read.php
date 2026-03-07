
<?php
      // Show all quotes
      $result = $quote->read();
      $num = $result->rowCount();

      if($num > 0) {
        $quotes_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author_id' => $author_id,
            'category_id' => $category_id
          );
          array_push($quotes_arr, $quote_item);
        }

        echo json_encode($quotes_arr);
      } else {
        echo json_encode(
          array('message' => 'No Quotes Found')
        );
      }

      ?>