<?php
class User {
    private static $instance;
    private $dbh;

    private function __construct() {
	$this->dbh = Database::instance()->connection();
    }

    public static function instance() {
	if (!isset(self::$instance)) {
	    $class = __CLASS__;
	    self::$instance = new $class;
	}

	return self::$instance;
    }

    public function add($user) {
	$query = "insert into users(username, fullname, password, email, "
	    . "reg_date) values(?, ?, ?, ?, now())";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($user['username'], $user['fullname'],
	    $user['password'], $user['email']));
    }

    public function exists($user) {
	$query = "select count(*) from users where username = ?";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($user));
	return $sth->fetchColumn() > 0;
    }
}
?>
