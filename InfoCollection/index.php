<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 11/23/16
 * Time: 9:10 PM
 */
require_once "DB_login.php";
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $sign = 1;  //信息正确性标志
    /*
     * 对输入信息进行验证
     */

    $message = "";

    $username = htmlentities($username, ENT_QUOTES, "UTF-8");
    $phone = htmlentities($phone, ENT_QUOTES, "UTF-8");
    $address = htmlentities($address, ENT_QUOTES, "UTF-8");

    if (strlen($username) > 40 or strlen($username) < 1) {
        $message = $message . "<p>姓名为空或过长！</p><br/>";
        $sign = 0;
    } elseif (strlen($phone) != 11) {
        $message = $message . "<p>手机号码输入错误！</p><br/>";
        $sign = 0;
    } elseif (strlen($address) < 1) {
        $message = $message . "<p>地址不能为空！</p><br/>";
    }
    if ($sign) {
        /*
        * 连接数据库
        */
        $connect = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD);
        /*
        * 如果连接失败，则直接结束
        */
        if (!$connect) {
            die("Connect DataBase Error!<br/>");
        }

        $select = $connect->select_db($DB_NAME);

        $query = 'SELECT id,count(id) FROM information WHERE phone = \'' . $phone . '\';';
        $result = $connect->query($query);
        $count = 0;
        $id = -1;
        while ($row = $result->fetch_array()) {
            $count = $row["count(id)"];
            $id = $row["id"];
        }
        if ($count == 0) {
            $query = 'INSERT INTO information(name,phone,address) VALUES (\'' . $username . '\',\'' . $phone . '\',\'' . $address . '\')';
            $result = $connect->query($query);
            if (!$result) {
                $message = "提交失败！";
            } else {
                $message = "提交成功！";
            }
        } else {
            $query = 'UPDATE information SET name=\'' . $username . '\',phone=\'' . $phone . '\',address=\'' . $address . '\' WHERE id =' . $id . ';';
            $result = $connect->query($query);
            if (!$result) {
                $message = "更新失败！";
            } else {
                $message = "更新成功！";
            }
        }
    }
    /*
    * 选择数据库
    */
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>信息收集</title>

    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <link rel="shortcut icon" href="assets/images/xiyoulinux.png">
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <!-- text fonts -->
    <link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <span class="red"></span>

                            <span class="white" id="id-text2">西邮Linux兴趣小组</span>
                        </h1>
                        <h4 class="blue" id="id-company-text">十周年礼品派发信息收集系统</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-coffee green"></i>
                                        请输入您的信息
                                    </h4>

                                    <div class="space-6"></div>

                                    <form method="post" action="index.php">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"
                                                                   placeholder="姓名" name="username"
                                                                   value="<?php echo $username ?>" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"
                                                                   placeholder="电话" name="phone"
                                                                   value="<?php echo $phone ?>" required/>
															<i class="ace-icon fa fa-phone"></i>
														</span>
                                            </label>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"
                                                                   placeholder="地址" name="address"
                                                                   value="<?php echo $address ?>" required/>
															<i class="ace-icon fa fa-home"></i>
														</span>
                                            </label>

                                            <div class="clearfix">

                                                <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">提交</span>
                                                </button>
                                            </div>
                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>

                                    </div>

                                    <div>
                                        <a href="search.php" class="user-signup-link">
                                            信息查询
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.main-content -->
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="assets/js/jquery.2.1.1.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="assets/js/jquery.1.11.1.min.js"></script>
    <![endif]-->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>" + "<" + "/script>");
    </script>
    <![endif]-->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <div style="text-align:center;">
        <br/>
        <br/>
        <br/>
        <p style="color: #dc1275; font-size: 20px;">
            <?php
            echo $message;
            ?>
        </p>
    </div>
</body>
</html>

