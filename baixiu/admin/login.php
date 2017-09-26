<?php

  require '../functions.php';
  
  $message='';

  if(!empty($_POST)){
    $email=$_POST['email'];
    $password=$_POST['password'];
    //连接数据库
    /*$connect=mysqli_connect('localhost','root','root');
    mysqli_select_db($connect,'baixiu');
    mysqli_set_charset($connect,'utf-8');//防止出现乱码
    //select * from users where email="$email" 需要出现一对双引号 用拼接完成
    $result=mysqli_query($connect,'SELECT * FROM users WHERE email="'.$email.'"');
    $row=mysqli_fetch_assoc($result);*/
    $rows=query('SELECT * FROM users WHERE email="'.$email.'"');

    if($rows[0]){
      if($rows[0]['password']==$password){

        session_start();
        $_SESSION['user_info']=$rows[0];

        header('Location:/admin');
        // / ~~ http://域名或ip/
        exit;
      }else{
        $message='邮箱或密码不正确';
      }
    }else{
        $message='邮箱不存在';
    }
  }



?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <?php include './inc/style.php'; ?>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action="./login.php" method="post">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if(!empty($message)) { ?>
     <div class="alert alert-danger">
       <strong>错误！</strong><?php echo $message; ?>
     </div>
     <?php } ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus  name="email">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码" name="password">
      </div>,;
      <input class="btn btn-primary btn-block" type="submit" value="登录"/>
    </form>
  </div>
</body>
</html>
