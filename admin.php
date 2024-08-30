<?php 

// 包含本应用程序的函数文件 
require_once('book_sc_fns.php');
if(!isset($_SESSION)){ 
    session_start(); 
}


if (( ! empty ( $_POST['username'])) && ! empty ($_POST['passwd'])) {
	// they have just tried logging in

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (login($username, $passwd)) {
      // if they are in the database register the user id
      $_SESSION['admin_user'] = $username;

   } else {
      // unsuccessful login
      do_html_header("问题：");
      echo "<p>您不能登录。<br/>
            必须登录才能查看此页。</p>";
      do_html_url('login.php', '登录');
      do_html_footer();
      exit;
    }
}

do_html_header("后台管理");
if (check_admin_user()) {
  display_admin_menu();
} else {
  echo "<p>您无权进入管理区域。 </p>";
}
do_html_footer();

?>
