<!DOCTYPE html>
<?php session_start();
require_once("/var/www/html/debug/header/myHeader.php");
$hLog = new HCH_LOG("test", $_SERVER['PHP_SELF'], "메인 페이지.", $_SERVER['REMOTE_ADDR']);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>
<h1>MAIN</h1>
<?php

$session_user_id = null;
$session_user_name = null;

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "<p>로그인을 해 주세요.</p>";
    echo "<p><button onclick=\"window.location.href='login.php'\">로그인</button> <button onclick=\"window.location.href='join.php'\">회원가입</button></p>";

    $hLog->info("m3 로그아웃 버튼", compact("session_user_id", "session_user_name"));
} else {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

    $session_user_id = $_SESSION['user_id'];
    $session_user_name = $_SESSION['user_name'];

    $hLog->info("m2 -  로그인 된 페이지",
        compact("session_user_id", "session_user_name"));
    echo "<p>$user_name($user_id)님 환영합니다.";
    echo "<p><button onclick=\"window.location.href='logout.php'\">로그아웃</button></p>";
}
?>
</body>
</html>