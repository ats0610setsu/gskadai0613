
<?php
// session_start();
if(
    !isset($_SESSION["chk_ssid"]) ||
    $_SESSION["chk_ssid"]!=session_id()
    ){
        header("Location: login.php");
        //   exit("LOGIN ERROR");
    }else{
      session_regenerate_id(true);
      $_SESSION["chk_ssid"]=session_id();
    }

?>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="select.php">アンケート一覧</a>
            <?php if($_SESSION["kanri_flg"]=="1"){?>
            <a class="navbar-brand" href="user.php">ユーザー登録</a>
            <?php }?>
            <a class="navbar-brand" href="user_select.php">ユーザー一覧</a>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            
        </div>
    </div>
</nav>
