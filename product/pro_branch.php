<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
</head>
<body>

<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {

    echo 'ログインされていません。<br />';
    echo '<a href="../login/staff_login.html">ログイン画面へ</a>';
    exit();
}


//参照
    if(isset($_POST['disp']) == true) {


        if(isset($_POST['procode']) == false) {

            header('Location:pro_ng.php');
            exit();
        }
        $pro_code=$_POST['procode'];
        header('Location:pro_disp.php?procode='.$pro_code);
        exit();

    }
    //追加
    if(isset($_POST['add']) == true) {


            header('Location:index.php');
            exit();

    }
    //編集
    if(isset($_POST['edit']) == true) {

        if(isset($_POST['procode']) ==false) {

            header('Location:pro_ng.php');
            exit();
        }

        $pro_code = $_POST['procode'];
        header('Location: pro_edit.php?procode ='.$pro_code);
        exit();
    }
    //削除
    if(isset($_POST['delete']) == true) {

        if(isset($_POST['procode']) ==false) {
            header('Location: pro_ng.php');
            exit();
        }

        $pro_code=$_POST['procode'];
        header('Location: pro_delete.php?procode='.$pro_code);
        exit();
    }


?>

</body>
</html>