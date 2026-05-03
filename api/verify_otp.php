<?php
session_start();
include("connect.php");

$user_otp = $_POST['otp'];

if(time() - $_SESSION['otp_time'] > 120){
    echo "<script>alert('OTP Expired'); window.location='../routes/otp.html';</script>";
    exit();
}

if($user_otp == $_SESSION['otp'])
{
    $mobile = $_SESSION['mobile'];
    $role = $_SESSION['role'];

    $userdata = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND role='$role'");
    $userdata = mysqli_fetch_array($userdata);

    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo "<script>window.location='../routes/dashboard.php';</script>";
}
else
{
    echo "<script>alert('Wrong OTP'); window.location='../routes/otp.html';</script>";
}
?>