<?php
      // Handle single quote by ID
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
      } 
      // Handle filtering by author_id and/or category_id
      else if(isset($_GET['author_id']) || isset($_GET['category_id'])) {
        // Build query with filters
        $query = 'SELECT id, quote, author_id, category_id FROM quotes WHERE 1=1';
        
        if(isset($_GET['author_id'])) {
          $query .= ' AND author_id = :author_id';
        }
        if(isset($_GET['category_id'])) {
          $query .= ' AND category_id = :category_id';
        }
        
        $query .= ' ORDER BY id DESC';
        
        // Prepare and execute
        $stmt = $db->prepare($query);
        
        if(isset($_GET['author_id'])) {
          $stmt->bindParam(':author_id', $_GET['author_id']);
        }
        if(isset($_GET['category_id'])) {
          $stmt->bindParam(':category_id', $_GET['category_id']);
        }
        
        $stmt->execute();
        $num = $stmt->rowCount();

        if($num > 0) {
          $quotes_arr = array();
          $quotes_arr['data'] = array();

          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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