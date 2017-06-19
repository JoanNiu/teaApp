<?php
/**根据用户id查询订单数据**/
header('Content-Type:application/json');

$output = [];

@$userid = $_REQUEST['userid'];

if(empty($userid)){
    echo "[]"; //若客户端未提交用户id，则返回一个空数组，
    return;    //并退出当前页面的执行
}

//访问数据库
require('init.php');

$sql = "SELECT tea_order.oid,tea_order.userid,tea_order.phone,tea_order.addr,
tea_order.totalprice,tea_order.user_name,tea_order.order_time,
tea_orderdetails.did,tea_orderdetails.dishcount,tea_orderdetails.price,
tea_dish.name,tea_dish.img_sm

 from tea_order,tea_orderdetails,tea_dish
WHERE tea_order.oid = tea_orderdetails.oid and tea_orderdetails.did = tea_dish.did and tea_order.userid='$userid'";
$result = mysqli_query($conn, $sql);

$output['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($output);
?>
