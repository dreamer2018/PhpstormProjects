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
                        <div class="center">
                            <h1>
                                <span class="red"></span>
                                <span class="white" id="id-text2">西邮Linux兴趣小组</span>
                            </h1>
                            <h4 class="blue" id="id-company-text">十周年礼品派发信息收集系统</h4>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-coffee green"></i>
                                        请输入手机号
                                    </h4>
                                    <div class="space-6"></div>

                                    <form action="search.php" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"
                                                                   placeholder="手机号""
                                                                   name="phone" required/>
															<i class="ace-icon fa fa-phone"></i>
														</span>
                                            </label>
                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">查询</span>
                                                </button>
                                            </div>
                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                    <div>
                                        <?php
                                        /**
                                         * Created by PhpStorm.
                                         * User: zhoupan
                                         * Date: 11/23/16
                                         * Time: 11:27 PM
                                         */
                                        require_once "DB_login.php";
                                        if (isset($_POST['phone'])) {
                                            $phone = $_POST['phone'];
                                            $message = "";
                                            $sign = 1;

                                            $phone = htmlentities($phone, ENT_QUOTES, "UTF-8");
                                            if (strlen($phone) != 11) {
                                                $message = $message . "手机号码错误！";
                                                $sign = 0;
                                            }
                                            if ($sign == 1) {
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

                                                $query = 'SELECT id,name,phone,address FROM information WHERE phone = \'' . $phone . '\';';
                                                $result = $connect->query($query);
                                                while ($row = $result->fetch_array()) {
                                                    echo '<label class="block clearfix">';
                                                    echo "<h5>";
//                                                    echo 'id:  ' . $row['id'] . '<br/>';
                                                    echo '姓&nbsp;&nbsp;&nbsp;&nbsp;名:&nbsp;&nbsp;' . $row['name'] . '<br/>';
                                                    echo "<br/>";
                                                    echo '手机号:&nbsp;&nbsp;' . $row['phone'] . '<br/>';
                                                    echo "<br/>";
                                                    echo '地&nbsp;&nbsp;&nbsp;&nbsp;址:&nbsp;&nbsp;' . $row['address'] . '<br/>';
                                                    echo "<br/>";
                                                    echo "</h5>";
                                                    echo '</label>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="toolbar clearfix">

                                    <div>
                                        <a href="index.php" data-target="#signup-box" class="user-signup-link">

                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            提交信息
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->
                    </div><!-- /.position-relative -->
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
</body>
</html>

