<?php
require_once("/var/www/html/debug/header/myHeader.php");
$hLog = new HCH_LOG("test", $_SERVER['PHP_SELF'], "test 로그입니다.", $_SERVER['REMOTE_ADDR']);


if (!isset($_POST['join_name']) || !isset($_POST['join_id']) || !isset($_POST['join_pw'])) {
    header("Content-type: text/html; charset=UTF-8");
    echo "<script>alert('기입하지 않은 정보가 있거나 잘못된 접근입니다.')";
    echo "window.location.replace('join.php');</script>";
    exit;
}
$join_name = $_POST['join_name'];
$join_id = $_POST['join_id'];
$join_pw = $_POST['join_pw'];

$hLog->info("db config 후", compact("join_id"));
//신규 회원정보 삽입 + ID 재정렬
$multi = "
        INSERT INTO member(id, name, password) 
        VALUES ('{$join_id}', '{$join_name}', '{$join_pw}')
        ";
$res = mysqli_multi_query($conn,$multi);

$hLog->info("db 쿼리 후", compact("join_id"));

if($res){
    echo "<script>alert('회원가입이 완료되었습니다.');";
    echo "window.location.replace('login.php');</script>";
    exit;
}
else{
    echo "<script>alert('저장에 문제가 생겼습니다. 관리자에게 문의해주세요.');";
    echo mysqli_error($conn);
}

?>
<meta http-equiv="refresh" content="0;url=main.php">