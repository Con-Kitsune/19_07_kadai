<?php

$id = $_GET["id"];
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_tabel WHERE id=:id");
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
    <legend> <img src="img/motogp.svg" alt="" height=133 Width=243>MotoGP Data Analytics</legend>

     <label>Rider：<input type="text" name="Rider" value="<?=$rs['rider']?>"></label><br>
     <label>Circuit：<input type="text" name="Circuit" value="<?=$rs['circuit']?>"></label><br>
     <label>Session：<input type="radio" name="Session" checked="Q1" value="<?php if($rs['session'] == 'Q1') { print'checked';}?>">FP1
     <input type="radio" name="Session" value="Q2" checked="<?php if($rs['session']=='Q2'){print"checked";}?>">FP2
     <input type="radio" name="Session" value="Q3" checked="<?php if($rs['session']=='Q3'){print"checked";}?>">FP3
     <input type="radio" name="Session" value="Q4" checked="<?php if($rs['session']=='Q4'){print"checked";}?>">FP4
     <input type="radio" name="Session" value="P1" checked="<?php if($rs['session']=='P1'){print"checked";}?>">Q1
     <input type="radio" name="Session" value="P2" checked="<?php if($rs['session']=='P2'){print"checked";}?>">Q2
     <input type="radio" name="Session" value="RAC" checked="<?php if($rs['session']=='RAC'){print"checked";}?>">WUP
     <br>
     <label>Manufacturer：<select name="Manufacturer">
        <option value="HONDA" "<?php if($rs['manufacturer']=='HONDA'){print'selected';}?>">HONDA</option>
        <option value="YAMAHA" "<?php if($rs['manufacturer']=='YAMAHA'){print'selected';}?>">YAMAHA</option>
        <option value="DUCATI" "<?php if($rs['manufacturer']=='DUCATI'){print'selected';}?>">DUCATI</option>
        <option value="SUZUKI" "<?php if($rs['manufacturer']=='SUZUKI'){print'selected';}?>">SUZUKI</option>
        <option value="KTM" "<?php if($rs['manufacturer']=='KTM'){print'selected';}?>">KTM</option>
        <option value="APRILIA" "<?php if($rs['manufacturer']=='APRILIA'){print'selected';}?>">Aprilia</option>
        </select></label><br>
     <label>Laptime：<input type="text" name="Laptime" value="<?=$rs["laptime"]?>"></label><br>
     <label><textArea name="Comment" rows="4" cols="40"> <?=$rs["comment"]?></textArea></label><br>
     <input type="submit" value="Subit">
     <input type="hidden" name="id" value="<?=$rs["id"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
