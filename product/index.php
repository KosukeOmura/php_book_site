<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false) {
        echo 'ログインできません';
        echo '<a href="../login/staff_login.html">ログイン画面へ</a>';
        exit();
    }else {

        echo $_SESSION['staff_name'];
        echo 'さんログイン中 <br />';
        echo '<br />';
    }
    
    ?>

商品追加 <br />
<br />
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">

商品名を入力してください。<br/>
<input type="text" name="name" style="width:200px"> <br />
価格を入力してください。<br />
<input type="text" name="price" style="width:50px"> <br />
画像を選んでください。<br />
<input type="file" name="image" style="width:400px"><br />
<br />
<input type="button" onclick="history.back()" value="戻る" >
<input type="submit" value="OK">

</form>
    
</body>
</html>