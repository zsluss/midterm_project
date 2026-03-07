<?php 
  class Database {
    // DB Params
    private $host; 
    private $port; 
    private $db_name; 
    private $username; 
    private $password; 
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      $database_url = getenv('DATABASE_URL') ?: getenv('CONNECTION');

      if(!empty($database_url)) {
        $url = parse_url($database_url);
        parse_str(isset($url['query']) ? $url['query'] : '', $queryParams);

        $this->host = $url['host'] ?? getenv('HOST');
        $this->port = $url['port'] ?? (getenv('DB_PORT') ?: '5432');
        $this->db_name = isset($url['path']) ? ltrim($url['path'], '/') : getenv('DBNAME');
        $this->username = $url['user'] ?? getenv('USERNAME');
        $this->password = $url['pass'] ?? getenv('PASSWORD');
        $sslmode = $queryParams['sslmode'] ?? (getenv('SSLMODE') ?: 'require');
      } else {
        $this->host = getenv('HOST');
        $this->port = getenv('DB_PORT') ?: '5432';
        $this->db_name = getenv('DBNAME');
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $sslmode = getenv('SSLMODE') ?: 'require';
      }

      try { 
        $this->conn = new PDO('pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name . ';sslmode=' . $sslmode, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(array('message' => 'Connection Error: ' . $e->getMessage()));
        exit();
      }

      return $this->conn;
    }
  }