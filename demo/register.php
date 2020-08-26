<?php
  //设置编码格式，设置utf-8
  header('content-type:text/html;charset="utf-8"');
  $responseData = array("code" => 0, "msg" => "");

  //现将传过来的数据全部取出
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];
  $createtime = $_POST['createtime'];

  //后台，进行一个简单的验证
  if(!$phone){
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
  if($password != $repassword){
    $responseData['code'] = 3;
    $responseData['msg'] = "两次密码输入不一致";
    echo json_encode($responseData);
    exit;
  }


  //1、链接数据库
  $link = mysql_connect("127.0.0.1", "root", "123456");

  //2、判断数据库是否链接成功
  if(!$link){
    $responseData['code'] = 6;
    $responseData['msg'] = "服务器忙";
    echo json_encode($responseData);
    exit; //退出程序
  }

  //3、设置访问字符集
  mysql_set_charset("utf8");

  //4、选择访问的数据库
  mysql_select_db("login");


  //5、准备sql 判断之前是否注册过
  $sql = "SELECT * FROM users WHERE phone='{$phone}'";

  //6、发送
  $res = mysql_query($sql);

  //取出一行
  $row = mysql_fetch_assoc($res);

  if($row){
    $responseData['code'] = 4;
    $responseData['msg'] = "用户名已存在";
    echo json_encode($responseData);
    exit;
  }

  //密码加密处理
  $str = md5(md5(md5($password).'qianfeng').'qingdao');

  $sql2 = "INSERT INTO users(phone,password,createtime) VALUES('{$phone}','{$str}',{$createtime})";

  $res = mysql_query($sql2);

  if($res){
    $responseData["msg"] = "注册成功";
    echo json_encode($responseData);
  }else{
    $responseData['code'] = 5;
    $responseData['msg'] = "注册失败";
    echo json_encode($responseData);
    exit;
  }

  mysql_close($link);

?>