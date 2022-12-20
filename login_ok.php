<?php
require_once("/var/www/html/debug/header/myHeader.php");
$hLog = new HCH_LOG("test", $_SERVER['PHP_SELF'], "로그인 처리 페이지", $_SERVER['REMOTE_ADDR']);

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

$hLog->info("lgn1 - 전달받은 id, pw", compact("user_id", "user_pw"));

//$sql = "SELECT * FROM member where id='$user_id' and password='$user_pw'";
//$res = mysqli_fetch_array(mysqli_query($conn,$sql));

try {
    $statement = $pdo->prepare("SELECT * FROM member where ids= ? and password=?");
    $statement->execute([$user_id, $user_pw]); // ?에 값이 들어간다, ?, ?, ... ?가 늘어나면  [$변수명, $변수명,... ] 해결한다
    $res = $statement->fetch(); // db에서 가져온 값을 array에 담는다

} catch (PDOException $e){
    echo $output = 'DB Error<br>' . $e . '<br>';
    echo $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    $hLog->info("에러 저옵", compact("e"));
    exit();
}


if($res){
    $q_id = $res['id'];
    $q_name = $res['name'];
    $hLog->info("lgn2 - select 쿼리 성공, id, name 받기",
        compact("q_id", "q_name"));

    session_start();
    $_SESSION['user_id'] = $res['id'];
    $_SESSION['user_name'] = $res['name'];
    echo "<script>alert('로그인에 성공했습니다!');";
    echo "window.location.replace('main.php');</script>";

    $session_user_id = $_SESSION['user_id'];
    $session_user_name = $_SESSION['user_name'];
    $hLog->info("lgn3 - 세션 정보",
        compact("session_user_id", "session_user_name"));
    exit;
}
else{
    echo "<script>alert('아이디 혹은 비밀번호가 잘못되었습니다.');";
    echo "window.location.replace('login.php');</script>";
}
?>
<meta http-equiv="refresh" content="0;url=main.php">