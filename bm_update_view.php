<?php
//1.POSTでParamを取得
$id = $_GET["id"];  

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root', '');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．データ取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch(); //$row["name"]
}


//４.　データ表示

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
//$stmt = $pdo->prepare("UPDATE gs_bm_table SET title=:title,url=:url,comment=:comment WHERE id=:id");
//$stmt->bindValue(':title', $title);
//$stmt->bindValue(':url', $url);
//$stmt->bindValue(':comment', $comment);
//$stmt->bindValue(':id', $id);
//$status = $stmt->execute();

?>
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
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍</legend>
     <label>タイトル：<input type="text" name="title" value="<?=$row["title"]?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
    <label>コメント：<input type="text" name="comment" value="<?=$row["comment"]?>"></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
