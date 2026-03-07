
<?php
      if(isset($_GET['id'])) {
        $author->id = $_GET['id'];
        $author->read_single();
        echo json_encode(array(
          'id' => $author->id,
          'author' => $author
        ));
      } else {
        $result = $author->read();
        $num = $result->rowCount();

        if($num > 0) {
          $authors_arr = array();
          $authors_arr['data'] = array();

          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $author_item = array(
              'id' => $id,
              'author' => $author
            );
            array_push($authors_arr['data'], $author_item);
          }

          echo json_encode($authors_arr);
        } else {
          echo json_encode(
            array('message' => 'author_id Not Found')
          );
        }
      }

      ?>