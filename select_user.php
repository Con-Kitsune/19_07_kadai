<?php
session_start();
include("functions.php");
chk_ssid();
//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table;");
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
      $view .='<a href="detail_user.php?id='.$result["id"].'">';
      $view .=$result["name"]."-".$result["lid"];
      $view .="</a>";
      $view .=' ';
      $view .='<a href="delete_user.php?id='.$result["id"].'">';
      $view .='［削除］';
      $view .='</a>';
      $view .="</p>";
  
  }
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
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
      <a class="navbar-brand" href="index_user.php">USER登録</a>
      <a class="navbar-brand" href="select7.php">アンケートデータ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
      <legend> USER一覧</legend>
      <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>

</html>