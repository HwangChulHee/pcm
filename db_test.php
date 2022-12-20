<?php
require_once("/var/www/html/debug/header/myHeader.php");
$hLog = new HCH_LOG("db_test", $_SERVER['PHP_SELF'], "db_test", $_SERVER['REMOTE_ADDR']);

try {
//    $statement = $pdo->prepare("SELECT id AS id,
//                                (
//                                CASE
//                                  WHEN kind = ? THEN 'fruit'
//                                  WHEN kind = ? THEN 'vegetable'
//                                  WHEN kind = ? THEN 'animal'
//                                  ELSE 'not'
//                                    END
//                                ) AS type,
//                                object
//                            FROM
//                                test");
    $statement = $pdo->prepare("SELECT id AS id,
                                (
                                CASE
                                    WHEN kind = ? THEN 'fruit'
                                    ELSE 'not'
                                    END
                                ) AS type,
                                object 
                            FROM
                                test");
    $num1 = 1;
    $num2 = 2;
    $num3 = 3;
    $statement->execute([$num1, $num2, $num3]); // ?에 값이 들어간다, ?, ?, ... ?가 늘어나면  [$변수명, $변수명,... ] 해결한다
    $res = $statement->fetch(); // db에서 가져온 값을 array에 담는다
//    echo json_encode(array($res), JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    print_r(array($res));

} catch (PDOException $e){
    echo $output = 'DB Error<br>' . $e . '<br>';
    echo $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    $hLog->info("에러", compact("e"));
    exit();
}

?>