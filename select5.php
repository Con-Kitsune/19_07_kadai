<?php
session_start();
include("functions.php");
chk_ssid();
//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_tabel ;");
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
    if($result["rider"]== 'ROSSI'){
      if($result["Session"]=='Q1'){
        if($result["laptime"]!= null){
        $VR46[1]=$result["laptime"];
        }else{$VR46[1]=0;}}
      if($result["Session"]=='Q2'){
        if($result["laptime"]!= null){
        $VR46[2]=$result["laptime"];
        }else{$VR46[2]=0;}}
      if($result["Session"]=='Q3'){
        if($result["laptime"]!= null){
        $VR46[3]=$result["laptime"];
        }else{$VR46[3]=0;}}
      if($result["Session"]=='Q4'){
        if($result["laptime"]!= null){
        $VR46[4]=$result["laptime"];
        }else{$VR46[4]=0;}}
      if($result["Session"]=='P2'){
        if($result["laptime"]!= null){
        $VR46[5]=$result["laptime"];
        }else{$VR46[5]=0;}}
      if($result["Session"]=='RAC'){
        if($result["laptime"]!= null){
        $VR46[6]=$result["laptime"];
        }else{$VR46[6]=0;}}
    }

    if($result["rider"]== 'MARQUEZ'){
      if($result["Session"]=='Q1'){
        if($result["laptime"]!= null){
        $MM99[1]=$result["laptime"];
        }else{$MM99[1]=0;}}
      if($result["Session"]=='Q2'){
        if($result["laptime"]!= null){
        $MM99[2]=$result["laptime"];
        }else{$MM99[2]=0;}}
      if($result["Session"]=='Q3'){
        if($result["laptime"]!= null){
        $MM99[3]=$result["laptime"];
        }else{$MM99[3]=0;}}
      if($result["Session"]=='Q4'){
        if($result["laptime"]!= null){
        $MM99[4]=$result["laptime"];
        }else{$MM99[4]=0;}}
      if($result["Session"]=='P2'){
        if($result["laptime"]!= null){
        $MM99[5]=$result["laptime"];
        }else{$MM99[5]=0;}}
      if($result["Session"]=='RAC'){
        if($result["laptime"]!= null){
        $MM99[6]=$result["laptime"];
        }else{$MM99[6]=0;}}
    }
    if($result["rider"]== 'DOVIZIOSO'){
      if($result["Session"]=='Q1'){
        if($result["laptime"]!= null){
        $AD04[1]=$result["laptime"];
        }else{$AD04[1]=0;}}
      if($result["Session"]=='Q2'){
        if($result["laptime"]!= null){
        $AD04[2]=$result["laptime"];
        }else{$AD04[2]=0;}}
      if($result["Session"]=='Q3'){
        if($result["laptime"]!= null){
        $AD04[3]=$result["laptime"];
        }else{$AD04[3]=0;}}
      if($result["Session"]=='Q4'){
        if($result["laptime"]!= null){
        $AD04[4]=$result["laptime"];
        }else{$AD04[4]=0;}}
      if($result["Session"]=='P2'){
        if($result["laptime"]!= null){
        $AD04[5]=$result["laptime"];
        }else{$AD04[5]=0;}}
      if($result["Session"]=='RAC'){
        if($result["laptime"]!= null){
        $AD04[6]=$result["laptime"];
        }else{$AD04[6]=0;}}
    }

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
      <a class="navbar-brand" href="index.php?source=graf">データ登録</a>
      <a class="navbar-brand" href="select.php?source=graf">manufacturer別</a>
      <a class="navbar-brand" href="select2.php?source=graf">rider別</a>
      <a class="navbar-brand" href="select3.php?source=graf">P1</a>
      <a class="navbar-brand" href="select4.php?source=graf">P2</a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P3</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">P4</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q1</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">Q2</span></a>
      <a class="navbar-brand" href="select3.php"><span class="gray">WUP</span></a>
      <a class="navbar-brand" href="select7.php?source=top">all data</a>
      <?php
      if(!isset($_SESSION["kanri_flg"])){
      }elseif($_SESSION["kanri_flg"] == 0){
        echo '<a class="navbar-brand" href="select_user.php?source=all">USER管理</a>';
      }
      ?>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <p class="MM">■Marc MARQUEZ</p>
  <p class="VR">■Valentino Rossi</p>
  <p class="AD">■Andrea DOVIZIOSO</p>

    <canvas id="mycanvas1" height="500" width="1400"></canvas>
</div>
<!-- Main[End] -->

</body>
<script>
        let VR=["<?= $VR46[1]; ?>","<?= $VR46[2]; ?>","<?= $VR46[3]; ?>","<?= $VR46[4]; ?>","<?= $VR46[5]; ?>","<?= $VR46[6]; ?>"];
        let MM=["<?= $MM99[1]; ?>","<?= $MM99[2]; ?>","<?= $MM99[3]; ?>","<?= $MM99[4]; ?>","<?= $MM99[5]; ?>","<?= $MM99[6]; ?>"];
        let AD=["<?= $AD04[1]; ?>","<?= $AD04[2]; ?>","<?= $AD04[3]; ?>","<?= $AD04[4]; ?>","<?= $AD04[5]; ?>","<?= $AD04[6]; ?>"];
        let lineChartData = {
          type:"line",
      labels : ["FP1","FP2","FP3","FP4","Q2","WUP"],
      datasets : [
         {
            label: "VR46",
            fillColor : "rgba(92,220,92,0.2)", // 線から下端までを塗りつぶす色
            strokeColor : "rgba(92,220,92,1)", // 折れ線の色
            pointColor : "rgba(92,220,92,1)",  // ドットの塗りつぶし色
            pointStrokeColor : "white",        // ドットの枠線色
            pointHighlightFill : "yellow",     // マウスが載った際のドットの塗りつぶし色
            pointHighlightStroke : "green",    // マウスが載った際のドットの枠線色
            data : [VR[0],VR[1],VR[2],VR[3],VR[4],VR[5]]     // 各点の値
         },
                  {
            label: "MM99",
            fillColor : "rgba(255,165,00,0.2)", // 線から下端までを塗りつぶす色
            strokeColor : "rgba(247,193,71,1)", // 折れ線の色
            pointColor : "rgba(255,165,00,1)",  // ドットの塗りつぶし色
            pointStrokeColor : "white",        // ドットの枠線色
            pointHighlightFill : "yellow",     // マウスが載った際のドットの塗りつぶし色
            pointHighlightStroke : "green",    // マウスが載った際のドットの枠線色
            data : [MM[0],MM[1],MM[2],MM[3],MM[4],MM[5]]     // 各点の値
         },
         {
            label: "AD04",
            fillColor : "rgba(255,79,25,0.2)", // 線から下端までを塗りつぶす色
            strokeColor : "rgba(255,98,50,1)", // 折れ線の色
            pointColor : "rgba(255,79,25,1)",  // ドットの塗りつぶし色
            pointStrokeColor : "white",        // ドットの枠線色
            pointHighlightFill : "yellow",     // マウスが載った際のドットの塗りつぶし色
            pointHighlightStroke : "green",    // マウスが載った際のドットの枠線色
            data : [AD[0],AD[1],AD[2],AD[3],AD[4],AD[5]]     // 各点の値
         },
      ]

   }

        let myChart1 = new Chart(document.getElementById("mycanvas1").getContext("2d")).Line(lineChartData);


   </script>
</html>
