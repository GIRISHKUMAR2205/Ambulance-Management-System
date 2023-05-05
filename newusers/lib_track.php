<?php
require_once "../session.php";
class Track {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  public $pdo = null;
  public $stmt = null;
  public $error = "";
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CLOSE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) HELPER FUNCTION - EXECUTE SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }
 
  // (D) UPDATE RIDER COORDINATES
  function update ($id,$name,$email,$phonenu,$username,$password, $lng, $lat) {
    date_default_timezone_set('Asia/Calcutta');
    $this->query(
      "REPLACE INTO `newusers` (`id`, `name` ,`email`,`phonenu`,`username`,`password`, `track_time`, `lng`, `lat`) VALUES (?,?,?,?,?,?,?,?,?)",
      [$id, $name ,$email,$phonenu,$username,$password, date("Y-m-d H:i:s"), $lng, $lat]
    );
    return true;
  }
 
  // (E) GET RIDER(S) COORDINATES
  function get ($drivername=null) {
    $this->query(
      "SELECT * FROM `drivers`" . ($drivername==null ? "" : " WHERE `drivername`=?"),
      $drivername==null ? null : [$drivername]
    );
    return $this->stmt->fetchAll();
  }
}
 
// (F) DATABASE SETTINGS - CHANGE THESE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "ambulance");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");
 
// (G) START!
$_TRACK = new Track();