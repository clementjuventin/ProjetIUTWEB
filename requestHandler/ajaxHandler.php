<?

if(!isset($_REQUEST['action']) ) {
    exit;
}

$action = $_REQUEST['action'];

if( $action=="del" )
{
    echo "OK";

}
?>