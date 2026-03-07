<?php
  class Quote {
    // DB Stuff
    private $conn;
    private $table = 'quotes';

    // Properties
    public $id;
    public $quote; 
    public $author_id;
    public $category_id;
    public $author;
    public $category;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

            // Get quotes
    public function read() {
      // Create query
      $query = 'SELECT
        q.id,
        q.quote,
        q.author_id,
        q.category_id,
        a.author,
        c.category
      FROM
        ' . $this->table . ' q
      JOIN
        authors a ON q.author_id = a.id
      JOIN
        categories c ON q.category_id = c.id
      ORDER BY
        q.id ASC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Quote
  public function read_single(){
    // Create query
    $query = 'SELECT
          q.id,
          q.quote,
          q.author_id,
          q.category_id,
          a.author,
          c.category
        FROM
          ' . $this->table . ' q
        JOIN
          authors a ON q.author_id = a.id
        JOIN
          categories c ON q.category_id = c.id
      WHERE q.id = ?
      LIMIT 1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->quote = $row['quote'];
      $this->author_id = $row['author_id'];
      $this->category_id = $row['category_id'];
        $this->author = $row['author'];
        $this->category = $row['category'];
  }

  // Create Quote
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id) RETURNING id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->quote = htmlspecialchars(strip_tags($this->quote));
  $this->author_id = htmlspecialchars(strip_tags($this->author_id));
  $this->category_id = htmlspecialchars(strip_tags($this->category_id));

  // Bind data
  $stmt->bindParam(':quote', $this->quote);
  $stmt->bindParam(':author_id', $this->author_id);
  $stmt->bindParam(':category_id', $this->category_id);

  // Execute query
  if($stmt->execute()) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->id = $row['id'];
    return true;
  }

  return false;
  }

  // Update Quote
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      quote = :quote,
      author_id = :author_id,
      category_id = :category_id
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->quote = htmlspecialchars(strip_tags($this->quote));
  $this->author_id = htmlspecialchars(strip_tags($this->author_id));
  $this->category_id = htmlspecialchars(strip_tags($this->category_id));
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':quote', $this->quote);
  $stmt-> bindParam(':author_id', $this->author_id);
  $stmt-> bindParam(':category_id', $this->category_id);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  return false;
  }

  // Delete Quote
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    return false;
    }
  }