<?php
  //设置编码格式，设置utf-8
  header('content-type:text/html;charset="utf-8"');
  //在后台的行为的结果，必须传给前台，定义统一的格式去传输
  $responseData = array("code" => 0, "msg" => "");
  $username = $_POST['username'];
  $password = $_POST['password'];
   //后台，进行一个简单的验证
  if(!$username){
    $responseData['code'] = 1;
    $responseData['msg'] = "用户名不能为空";
    echo json_encode($responseData);
    exit;
  }

  if(!$password){
    $responseData['code'] = 2;
    $responseData['msg'] = "密码不能为空";
    echo json_encode($responseData);
    exit;
  }

  //高级判断，判断之前是否注册过
  //1、链接数据库
  $link = mysqli_connect("127.0.0.1", "root", "123456abc");

  //2、判断数据库是否链接成功
  if(!$link){
    $responseData['code'] = 6;
    $responseData['msg'] = "服务器忙";
    echo json_encode($responseData);
    exit; //退出程序
  }

  //3、设置访问字符集
  mysqli_set_charset($link, "utf8");

  //4、选择访问的数据库
  mysqli_select_db($link, "qd2003");

  //密码加密处理
  $str = md5(md5(md5($password).'qianfeng').'qingdao');

  //准备sql，判断是否能够登陆成功
  $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$str}'";

  $res = mysqli_query($link, $sql);

  //取一行
  $row = mysqli_fetch_assoc($res);

  if($row){
    $responseData['msg'] = "登陆成功";
    echo json_encode($responseData);
  }else{
    $responseData['code'] = 3;
    $responseData['msg'] = "用户名或密码错误";
    echo json_encode($responseData);
    exit;
  }

  mysqli_close($link);
?>