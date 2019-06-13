<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//1.  DB接続します
include("funcs.php");
$pdo = db_con();

//2. データ登録SQL作成
$lid =$_POST["lid"];
$lpw =$_POST["lpw"];
$sql = "SELECT * FROM gs_user_table WHERE lid=:lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sqlError($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if( password_verify($lpw, $val["lpw"])){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: bm_list_view.php");
}else{
  //Login失敗時(Logout経由)
  header("Location: logout.php");
}
exit();
?>

