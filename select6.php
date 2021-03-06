<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT refarrer, COUNT(*) FROM gs_bm2_table GROUP BY refarrer;");
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
      $view .="<p>". $result["refarrer"]."-".$result["COUNT(*)"]."</p>";
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
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
 .MM{color:orange;} .VR{color:green;} .AD{color:red;}.gray{color:gray;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php?source=refarrer">データ登録</a>
      <a class="navbar-brand" href="select.php?source=refarrer">manufacturer別</a>
      <a class="navbar-brand" href="select2.php?source=refarrer">rider別</a>
      <a class="navbar-brand" href="select3.php?source=refarrer">P1</a>
      <a class="navbar-brand" href="select4.php?source=refarrer">P2</a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P3</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P4</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q1</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q2</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">WUP</span></a>
      <a class="navbar-brand" href="select5.php?source=refarrer">Graf</a>
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
