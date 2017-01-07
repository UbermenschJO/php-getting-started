<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

echo "connect by $server $username $password $db";

$mysqli = new mysqli($server, $username, $password, $db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$stmt = "create table if not exists `acc_log` (".
"`ip` varchar(15) not null,".
"`uri` varchar(100) not null,".
"`agent` varchar(100) not null,".
"`in_time` timestamp".
");";

if (!$mysqli->query($stmt)) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
?>
