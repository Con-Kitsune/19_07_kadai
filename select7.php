<?php

session_start();
include("functions.php");

if(!isset($_SESSION["name"])){
$_SESSION["name"] = "ゲスト";
}
// chk_ssid();
//1.  DB接続します
$pdo = db_con();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_tabel;");
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
  $i = '';
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
      $view .="<p>";
      $view .='<a href="detail.php?id='.$result["id"].'">';
      $view .=$result["rider"]."-".$result["laptime"];
      $view .="</a>";
      $view .=' ';
      $view .='<a href="delete.php?id='.$result["id"].'">';
      $view .='［削除］';
      $view .='</a>';
      $view .="</p>";
  
  }
}

// //移行疑似GA
// $source = $_GET["source"];

// //2. DB接続します
// try {
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('dbConnectError:'.$e->getMessage());
// }

// //３．データ登録SQL作成
// $sql = "INSERT INTO gs_bm2_table(id,refarrer,indate)
// VALUES(NULL,:a1,sysdate())";

// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':a1', $source , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $status = $stmt->execute();



?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>データ一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
 .MM{color:orange;} .VR{color:green;} .AD{color:red;}.gray{color:gray;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
<p>ようこそ <?=$_SESSION["name"] ?>さん</p>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <?php if(!isset($_SESSION["kanri_flg"])){
      echo '<a class="navbar-brand" href="login.php">LOGIN</a>';
      }else{
      echo '<a class="navbar-brand" href="logout.php">LOGOUT</a>';
      } ?>
      <?php if(!isset($_SESSION["kanri_flg"])){
    }else{
      echo '<a class="navbar-brand" href="index.php">データ登録</a>';
      }
      ?>
      <a class="navbar-brand" href="select.php?source=all">manufacturer別</a>
      <a class="navbar-brand" href="select2.php?source=all">rider別</a>
      <a class="navbar-brand" href="select3.php?source=all">P1</a>
      <a class="navbar-brand" href="select4.php?source=all">P2</a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P3</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P4</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q1</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q2</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">WUP</span></a>
      <?php if(!isset($_SESSION["kanri_flg"])){
      }else{
      echo '<a class="navbar-brand" href="select5.php">Graf</a>';
      }
      ?>
      <?php
      if(!isset($_SESSION["kanri_flg"])){
      }elseif($_SESSION["kanri_flg"] == 0){
        echo '<a class="navbar-brand" href="select_user.php?source=all">USER管理</a>';
      }
      ?>
      <!-- <a class="navbar-brand" href="select_user.php?source=all">USER管理</a> -->
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>

      <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>

</html>
