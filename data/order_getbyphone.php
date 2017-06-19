<?php
header('Content-Type:application/json');

@$phone = $_REQUEST['phone'];

if(empty($phone))
{
    echo '[]';
    return;
}

require('init.php');

$sql = "SELECT tea_order.oid,tea_order.addr,tea_order.order_time,tea_order.user_name,tea_dish.img_sm,tea_dish.did FROM tea_dish,tea_order WHERE tea_order.phone=$phone AND tea_order.did=tea_dish.did";
$result = mysqli_query($conn,$sql);

$output = [];
while(true){
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}

echo json_encode($output);

?>




