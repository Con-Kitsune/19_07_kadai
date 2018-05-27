<?php

if(
  !isset($_POST["Rider"]) || $_POST["Rider"]=="" ||
  !isset($_POST["Circuit"]) || $_POST["Circuit"]=="" ||
  !isset($_POST["Session"]) || $_POST["Session"]=="" ||
  !isset($_POST["Manufacturer"]) || $_POST["Manufacturer"]=="" ||
  !isset($_POST["Laptime"]) || $_POST["Laptime"]=="" ||
  !isset($_POST["Comment"]) || $_POST["Comment"]==""
){

  exit("ParamError");
}


//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$Rider = $_POST["Rider"];
$Circuit = $_POST["Circuit"];
$Session = $_POST["Session"];
$Manufacturer = $_POST["Manufacturer"];
$Laptime = $_POST["Laptime"];
$Comment = $_POST["Comment"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_tabel(id,Rider,Circuit,Session,Manufacturer,Laptime,Comment,indate)
VALUES(NULL,:a1,:a2,:a3,:a4,:a5,:a6,sysdate())";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $Rider , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $Circuit,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $Session,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $Manufacturer,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $Laptime,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $Comment,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  //５．index.phpへリダイレクト:後のスペースは必須
 header("Location: index.php");

}
?>
