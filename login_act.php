<?php

if(
 
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]==""
){

  exit("ParamError");
}
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid= '$lid' AND lpw= '$lpw';");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("sqlError(ログインエラー):".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  $rs = $stmt->fetch();
  if($rs['life_flg']=1){
    // header("Location: select7.php");
  }else{
    
  exit("sqlError(ログインエラー)");
  }

}

?>
<script type="text/javascript">
    window.onload = function(){
        document.postForm.submit();
    }
</script>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
</head>
<body>
<!-- Main[Start] -->
<form method="POST" action="select7.php" name="postForm">
     <input type="hidden" name="kanri_flg" value="<?=$rs["kanri_flg"]?>">
</form>
<!-- Main[End] -->


</body>
</html>
