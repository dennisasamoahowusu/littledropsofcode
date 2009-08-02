<?php
class Authenticator {
    private $dbh;

    function __construct() {
	$this->dbh = Database::instance()->connection();
    }

    function authenticate($creds) {
	$query = "select status from users "
	    . "where username = ? and password = ?";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($creds['username'], $creds['password']));
	$row = $dbh->fetch();

	$ret = array();
	if ($row['status'] == false) {
	    $ret['valid'] = false;
	    $ret['msg'] = 'Authentication failed';
	} elseif ($status == 'inactive') {
	    $ret['valid'] = false;
	    $ret['msg'] = 'This user account is inactive';
	} elseif ($status == 'active') {
	    $ret['valid'] = true;
	    $ret['msg'] = 'Logged in as ' . $creds['username'];
	} else {
	    $ret['valid'] = false;
	    $ret['msg'] = 'An unknown error occurred';
	}

	return $ret;
    }
}
