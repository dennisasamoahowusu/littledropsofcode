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

    public function validate($user) {
	$ret = array();
	if ($user['username'] == '') {
	    $ret['valid'] = false;
	    $ret['msg'] = 'No username specified';
	} elseif ($this->exists($user['username'])) {
	    $ret['valid'] = false;
	    $ret['msg'] = "A user with that username already exists";
	} else {
	    $ret['valid'] = true;
	    $ret['msg'] = 'Valid';
	}

	return $ret;
    }
}
?>
