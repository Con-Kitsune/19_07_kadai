<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">Manufacturer別</a>
    <a class="navbar-brand" href="select2.php">rider別</a>
    <a class="navbar-brand" href="select3.php">Q1</a>
    <a class="navbar-brand" href="select4.php">Q2</a>
    <a class="navbar-brand" href="select3.php">Q3</a>
    <a class="navbar-brand" href="select3.php">Q4</a>
    <a class="navbar-brand" href="select3.php">P1</a>
    <a class="navbar-brand" href="select3.php">P2</a>
    <a class="navbar-brand" href="select3.php">RAC</a>
    <a class="navbar-brand" href="select5.php">TEST</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>Rider：<input type="text" name="Rider"></label><br>
     <label>Circuit：<input type="text" name="Circuit"></label><br>
     <label>Session：<input type="radio" name="Session" value="Q1">Q1
     <input type="radio" name="Session" value="Q2">Q2
     <input type="radio" name="Session" value="Q3">Q3
     <input type="radio" name="Session" value="Q4">Q4
     <input type="radio" name="Session" value="P1">P1
     <input type="radio" name="Session" value="P2">P2
     <input type="radio" name="Session" value="RAC">RAC
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
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
