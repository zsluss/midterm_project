
<?php
      if(isset($_GET['id'])) {
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
      } else {
        $result = $quote->read();
        $num = $result->rowCount();

        if($num > 0) {
          $quotes_arr = array();
          $quotes_arr['data'] = array();

          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
              'id' => $id,
              'quote' => $quote,
              'author_id' => $author_id,
              'category_id' => $category_id
            );
            array_push($quotes_arr['data'], $quote_item);
          }

          echo json_encode($quotes_arr);
        } else {
          echo json_encode(
            array('message' => 'No Quotes Found')
          );
        }
      }

      ?>