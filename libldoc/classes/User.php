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

    public function getByUsername($username) {
	$query = "select * from users where username = ?";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($username));
	return $sth->fetch();
    }

    public function add($user) {
	$this->sanitize($user);

	$query = "insert into users(username, fullname, password, email, "
	    . "reg_date) values(?, ?, ?, ?, now())";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($user['username'], $user['fullname'],
	    $user['password'], $user['email']));
	return $this->getByUsername($user['username']);
    }

    public function exists($username) {
	$query = "select count(*) from users where username = ?";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($username));
	return $sth->fetchColumn() > 0;
    }

    public function emailExists($email) {
	$query = "select count(*) from users where email = ?";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($email));
	return $sth->fetchColumn() > 0;
    }

    public function validate($user) {
	$this->sanitize($user);

	$ret = array();
	if ($user['fullname'] == '') {
	    $ret['valid'] = false;
	    $ret['msg'] = "You did not enter your name";
	} elseif ($user['username'] == '') {
	    $ret['valid'] = false;
	    $ret['msg'] = 'No username specified';
	} elseif ($this->exists($user['username'])) {
	    $ret['valid'] = false;
	    $ret['msg'] = "A user with that username already exists";
	} elseif (!preg_match("/^[a-zA-Z][\w.]*$/", $user['username'])) {
	    $ret['valid'] = false;
	    $ret['msg'] = "The username contains invalid charachers";
	} elseif ($user['password'] == '') {
	    $ret['valid'] = false;
	    $ret['msg'] = 'You did not set a password';
	} elseif ($user['password'] != $user['password2']) {
	    $ret['valid'] = false;
	    $ret['msg'] = "The passwords do not match";
	} elseif ($user['email'] == '') {
	    $ret['valid'] = false;
	    $ret['msg'] = 'You did not specify your email';
	} elseif ($this->emailExists($user['email'])) {
	    $ret['valid'] = false;
	    $ret['msg'] = "A user is already registered with that email";
	} else {
	    $ret['valid'] = true;
	    $ret['msg'] = 'Valid';
	}

	return $ret;
    }

    private function sanitize(&$user) {
	$user['fullname'] = trim($user['fullname']);
	$user['username'] = trim($user['username']);
	$user['email'] = trim($user['email']);
    }
}
?>
