<?php

session_start();
if(
  !isset($_SESSION["chk_ssid"]) ||
  $_SESSION["chk_ssid"]!=session_id()
  ){
    header("Location: login.php");
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"]=session_id();
  }


include "funcs.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $view.='<p>';
      $view.='<a href="detail.php?id='.$result["id"].'">';
      $view .= $result["bookname"].",".$result["bookurl"].",".$result["indate"];

      $view.='</a>';

      $view.='';

      $view.='<a href="delete.php?id='.$result["id"]. '">';

      $view .= "[削除]";
      $view.='</a>';
  

      $view.='<p>';
    }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
<?php include('menu.php'); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
 <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
