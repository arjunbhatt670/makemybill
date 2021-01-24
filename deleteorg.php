<?php
session_start();
require_once "conn.php";
if(isset($_GET['id'])){
    $org_id=$_GET['id'];

    $sql="delete from product where orggstnum='$org_id'";
    if(!mysqli_query($conn,$sql))
    echo $conn->error;

    $sql2="delete from cust_details where orggstnum='$org_id'";
    if(!mysqli_query($conn,$sql2))
    echo $conn->error;

    $sql3="delete from bill where orggstnum='$org_id'";
    if(!mysqli_query($conn,$sql3))
    echo $conn->error;

    // $sql="delete organisation, product, cust_details, bill from organisation inner join product on product.orggstnum=organisation.orggstnum
    //  inner join cust_details on cust_details.orggstnum=product.orggstnum inner join bill on bill.orggstnum=product.orggstnum
    //   where uid=33";
    $sql4="delete from organisation where orggstnum='$org_id'";
    if(!mysqli_query($conn,$sql4))
    echo $conn->error;
    else
    header("location: addorg.php");
}









?>