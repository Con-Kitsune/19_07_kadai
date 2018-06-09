<?php
session_start();
//0.外部ファイル読み込み
include("functions.php");

// session処理
chk_ssid();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}
    .gray{color:gray;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
<p>ようこそ <?=$_SESSION["name"] ?>さん</p>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="select_user.php">USER一覧</a>
    </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert_user.php">
  <div class="jumbotron">
   <fieldset>
    <legend> 管理者追加</legend>

     <label>name：<input type="text" name="name" ></label><br>
     <label>LoginID：<input type="text" name="lid" ></label><br>
     <label>LoginPW：<input type="text" name="lpw" ></label><br>
     <label>管理フラグ：<input type="text" name="kanri_flg" ></label><br>
     <label>ライフフラグ：<input type="text" name="life_flg" </label><br>
     <input type="submit" value="Subit">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
