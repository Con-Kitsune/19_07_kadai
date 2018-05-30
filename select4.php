<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_tabel WHERE Session='Q2' ORDER BY laptime ASC;");
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
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .="<p>". $result["rider"]."-".$result["laptime"]."</p>";
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
<style>div{padding: 10px;font-size:16px;}
    .gray{color:gray;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php?source=P2">データ登録</a>
      <a class="navbar-brand" href="select.php?source=P2">manufacturer別</a>
      <a class="navbar-brand" href="select2.php?source=P2">rider別</a>
      <a class="navbar-brand" href="select3.php?source=P2">P1</a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P3</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P4</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q1</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q2</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">WUP</span></a>
      <a class="navbar-brand" href="select5.php?source=P2">Graf</a></div>
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
