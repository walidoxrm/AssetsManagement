  <?php
$ini = parse_ini_file('conf.ini');
$server = $ini['server'];
$Database = $ini['Database'];;
$UID = $ini['UID'];
$PWD = $ini['PWD'];
$CharacterSet = $ini['CharacterSet'];

$serverName = $server; 
$connectionInfo = array( "Database"=>$Database, "UID"=>$UID, "PWD"=>$PWD,"CharacterSet" =>$CharacterSet);
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {

	echo "Connection could not be established.\n";
    die( print_r( sqlsrv_errors(), true));

                      }


    ?>