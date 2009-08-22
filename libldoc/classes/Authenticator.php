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
	$row = $sth->fetch();

	$ret = array();
	if ($row['status'] == false) {
	    $ret['auth'] = false;
	    $ret['msg'] = 'Authentication failed';
	} elseif ($row['status'] == 'inactive') {
	    $ret['auth'] = false;
	    $ret['msg'] = 'This user account is inactive';
	} elseif ($row['status'] == 'active') {
	    $ret['auth'] = true;
	    $ret['msg'] = 'Logged in as ' . $creds['username'];
	} else {
	    $ret['auth'] = false;
	    $ret['msg'] = 'An unknown error occurred';
	}

	return $ret;
    }
}
?>
