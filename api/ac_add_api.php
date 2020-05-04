<?php
header("Content-Type: text/html; chartset=utf-8");

//引入判斷是否登入機制
require_once('../checkSession.php');

//引用資料庫連線
require_once('../db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `marketing` 
        ( `acId`, `acName`, `acDescription`, `acImg`, `sellerId`, `founder`) 
        VALUES (?, ?, ?, ?, ?, ?)";

if( $_FILES["acImg"]["error"] === 0 ) {
    //為上傳檔案命名
    $studentImg = date("YmdHis");//時間
    
    //找出副檔名
    $extension = pathinfo($_FILES["acImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $acImg = $studentImg.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["acImg"]["tmp_name"], "../asset/file_img/{$acImg}") ) {
        header("Refresh: 3; url=../page/activity/ac_index.php");
        echo "圖片上傳失敗";
        exit();
    }
    //繫結用陣列
    $arr = [
        $_POST['acId'],
        $_POST['acName'],
        $_POST['acDescription'],
        $acImg,
        $_POST['sellerId'],
        $_POST['founder']
    ];
    
    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->execute($arr);
    // print_r($sql);
    // exit();
    if($pdo_stmt->rowCount() === 1) {
        header("Refresh: 3; url=../page/activity/ac_index.php");
        echo "新增成功";
    } else {
        header("Refresh: 1000; url=../page/activity/ac_index.php");
        echo "新增失敗";
    }
}else{
    header("Refresh: 3; url=../page/activity/ac_index.php");
        echo "請夾帶圖片";
}
