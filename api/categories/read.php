
<?php
      if(isset($_GET['id'])) {
        $category->id = $_GET['id'];
        $category->read_single();
        echo json_encode(array(
          'id' => $category->id,
          'category' => $category->category
        ));
      } else {
        $result = $category->read();
        $num = $result->rowCount();

        if($num > 0) {
          $categories_arr = array();
          $categories_arr['data'] = array();

          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $category_item = array(
              'id' => $id,
              'category' => $category
            );
            array_push($categories_arr['data'], $category_item);
          }

          echo json_encode($categories_arr);
        } else {
          echo json_encode(
            array('message' => 'No Categories Found')
          );
        }
      }

      ?>