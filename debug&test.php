<?php
/* Connect to the local server using Windows Authentication. */
$serverName = "(local)";
$conn = sqlsrv_connect( $serverName);
if( $conn === false )
{
    echo "Could not connect.\n";
    die( print_r( sqlsrv_errors(), true));
}

$server_info = sqlsrv_server_info( $conn);
if( $server_info )
{
    foreach( $server_info as $key => $value)
    {
        echo $key.": ".$value."\n";
    }
}
else
{
    echo "Error in retrieving server info.\n";
    die( print_r( sqlsrv_errors(), true));
}

/* Free connection resources. */
sqlsrv_close( $conn);
?>