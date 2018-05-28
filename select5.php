<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError'.$e->getMessage());
}

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
    if($result["rider"]== 'Valentino Rossi'){
      if($result["Session"]=='Q1'){
        if($result["laptime"]!= null){
        $VR46[1]=$result["laptime"];
        }else{
          $VR46[1]=0;  
        }
      }
      if($result["Session"]=='Q2'){
        if($result["laptime"]!= null){
        $VR46[2]=$result["laptime"];
        }else{
          $VR46[2]=0;  
        }
      }
      if($result["Session"]=='Q3'){
        if($result["laptime"]!= null){
        $VR46[3]=$result["laptime"];
        }else{
          $VR46[3]=0;  
        }
      }
      if($result["Session"]=='Q4'){
        if($result["laptime"]!= null){
        $VR46[4]=$result["laptime"];
        }else{
          $VR46[4]=0;  
        }
      }
      if($result["Session"]=='P1'){
        if($result["laptime"]!= null){
        $VR46[5]=$result["laptime"];
        }else{
          $VR46[5]=0;  
        }
      }
      if($result["Session"]=='P2'){
        if($result["laptime"]!= null){
        $VR46[6]=$result["laptime"];
        }else{
          $VR46[6]=0;  
        }
      }
      if($result["Session"]=='RAC'){
        if($result["laptime"]!= null){
        $VR46[7]=$result["laptime"];
        }else{
          $VR46[7]=0;  
        }
      }
      
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
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <canvas id="mycanvas1" height="500" width="1400"></canvas>
</div>
<!-- Main[End] -->

</body>
<script>
        let VR=["<?= $VR46[1]; ?>","<?= $VR46[2]; ?>","<?= $VR46[3]; ?>","<?= $VR46[4]; ?>",null,"<?= $VR46[6]; ?>","<?= $VR46[7]; ?>"];
        let lineChartData = {
      labels : ["1","2","3","4","5","6","7"],
      datasets : [
         {
            label: "VR46",
            fillColor : "rgba(92,220,92,0.2)", // 線から下端までを塗りつぶす色
            strokeColor : "rgba(92,220,92,1)", // 折れ線の色
            pointColor : "rgba(92,220,92,1)",  // ドットの塗りつぶし色
            pointStrokeColor : "white",        // ドットの枠線色
            pointHighlightFill : "yellow",     // マウスが載った際のドットの塗りつぶし色
            pointHighlightStroke : "green",    // マウスが載った際のドットの枠線色
            data : [VR[0],VR[1],VR[2],VR[3],VR[4],VR[5],VR[6]]     // 各点の値
         },
         
      ]

   }

        let myChart1 = new Chart(document.getElementById("mycanvas1").getContext("2d")).Line(lineChartData);
   </script>
</html>
