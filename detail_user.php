<?php

$id = $_GET["id"];
session_start();
include("functions.php");
chk_ssid();
//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  $rs = $stmt->fetch();

}

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
    <div class="navbar-header"><a class="navbar-brand" href="select.php?source=top">Manufacturer別</a>
    <a class="navbar-brand" href="select2.php?source=top">rider別</a>
    <a class="navbar-brand" href="select3.php?source=top">P1</a>
    <a class="navbar-brand" href="select4.php?source=top">P2</a>
    <a class="navbar-brand" href="select3.php"><span class="gray">P3</span></a>
    <a class="navbar-brand" href="select3.php"><span class="gray">P4</span></a>
    <a class="navbar-brand" href="select3.php"><span class="gray">Q1</span></a>
    <a class="navbar-brand" href="select3.php"><span class="gray">Q2</span></a>
    <a class="navbar-brand" href="select3.php"><span class="gray">WUP</span></a>
    <a class="navbar-brand" href="select5.php?source=top">Graf</a>
    <a class="navbar-brand" href="select6.php?source=top">Refarrer(疑似Google Analytics)</a>
    <a class="navbar-brand" href="select7.php?source=top">all data</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend> ユーザー登録</legend>

     <label>name：<input type="text" name="name" value="<?=$rs['name']?>"></label><br>
     <label>LoginID：<input type="text" name="lid" value="<?=$rs['lid']?>"></label><br>
     <label>LoginPW：<input type="text" name="lpw" value="<?=$rs['lpw']?>"></label><br>
     <label>管理フラグ：<input type="text" name="kanri_flg" value="<?=$rs['kanri_flg']?>"></label><br>
     <label>ライフフラグ：<input type="text" name="life_flg" value="<?=$rs["life_flg"]?>"></label><br>
     <input type="submit" value="Subit">
     <input type="hidden" name="id" value="<?=$rs["id"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
