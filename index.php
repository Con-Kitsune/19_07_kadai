<?php


// FB担当者さまへ
// コード御確認いただき有難うございます。また汚いコードの羅烈になりすみません。
// お手数ですが、  最下部までお付き合いいただければと思います。
// 簡単に質問事項まとめさせていただきますので、合わせてご確認いただけると助かります。
// 【ご質問】
// データがNULLの時に別の処理をさせたかったのですが、if文でNULLを認識できませんでした。修正方法教えていただきたいです。
// データベースの使い方が浮かばなかったんですが、特殊な活用をしている例はありますか？
// 今回の内容とは別の話になりますが、トラッキングタグの作成＆設置はPHPでできるのでしょうか？
// 各ページの滞在時間はPHPでの取得となりますでしょうか？
// ユーザーIDごとにデータを格納したいのですが、IPアドレスなどを取得する方法はありますか？

//移行疑似GA
if($_GET["source"]=null){
 return;
}else{
$source = $_GET["source"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm2_table(id,refarrer,indate)
VALUES(NULL,:a1,sysdate())";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $source , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
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
    <a class="navbar-brand" href="select6.php?source=top">Refarrer(疑似Google Analytics)</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend> <img src="img/motogp.svg" alt="" height=133 Width=243>MotoGP Data Analytics</legend>

     <label>Rider：<input type="text" name="Rider"></label><br>
     <label>Circuit：<input type="text" name="Circuit"></label><br>
     <label>Session：<input type="radio" name="Session" value="Q1">FP1
     <input type="radio" name="Session" value="Q2">FP2
     <input type="radio" name="Session" value="Q3">FP3
     <input type="radio" name="Session" value="Q4">FP4
     <input type="radio" name="Session" value="P1">Q1
     <input type="radio" name="Session" value="P2">Q2
     <input type="radio" name="Session" value="RAC">WUP
     <br>
     <label>Manufacturer：<select name="Manufacturer">
        <option value="HONDA">HONDA</option>
        <option value="YAMAHA">YAMAHA</option>
        <option value="DUCATI">DUCATI</option>
        <option value="SUZUKI">SUZUKI</option>
        <option value="KTM">KTM</option>
        <option value="APRILIA">Aprilia</option>
        </select></label><br>
     <label>Laptime：<input type="text" name="Laptime"></label><br>
     <label><textArea name="Comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="Subit">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
