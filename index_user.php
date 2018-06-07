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
// if($_GET["source"]=null){
//  return;
// }else{
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
// }

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
    <div class="navbar-header">
    <a class="navbar-brand" href="select_user.php">USER一覧</a>
    </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert_user.php">
  <div class="jumbotron">
   <fieldset>
    <legend> 管理者追加</legend>

     <label>name：<input type="text" name="name" ></label><br>
     <label>LoginID：<input type="text" name="lid" ></label><br>
     <label>LoginPW：<input type="text" name="lpw" ></label><br>
     <label>管理フラグ：<input type="text" name="kanri_flg" ></label><br>
     <label>ライフフラグ：<input type="text" name="life_flg" </label><br>
     <input type="submit" value="Subit">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
