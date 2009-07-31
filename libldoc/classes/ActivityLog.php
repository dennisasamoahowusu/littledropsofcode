<?php
class ActivityLog {
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

    public function log($log) {
	$query = "insert into activity_log(log_date, log_type, log_user, "
	    . "log_summary) values(now(), (select type_id from log_types "
	    . "where log_type = ?), ?, ?)";
	$sth = $this->dbh->prepare($query);
	$sth->execute(array($log['type'], $log['user'], $log['summary']));
    }
}
?>
