<?php

/*
 * page manager
 */
$resources = BASE_PATH.'resources/';
$sites = $resources.'sites/';
$auth = $resources.'auth/';
$customer = $resources.'customer/';
$team = $resources.'team/';
$ts3musikbot = $resources.'customer/ts3musikbot/';
$ticket = $resources.'customer/ticketsystem/';
$admin = $resources.'customer/admin/';
$affiliate = $resources.'affiliate/';
$page = $helper->protect($_GET['page']);

if(isset($_GET['page'])) {
    switch ($page) {

        default: include($sites . "404.php");  break;

        case "runtime_queue": include(BASE_PATH . "app/crone/runtime_queue.php");  break;

        //auth
        case "auth_login": include($auth . "login.php");  break;
        case "auth_register": include($auth . "register.php");  break;
        case "auth_logout": setcookie('session_token', null, time(),'/'); header('Location: '.$helper->url().'login'); break;


        //debug
        case "DEBUG": include(BASE_PATH . "DEBUG/index.php");  break;

        // Nicht Kunde
        case "index": include($sites."index.php");  break;

        // Kunde
        case "dashboard": include($customer."dashboard.php");  break;
        //case "attacks": include($customer."attacks.php");  break;
        //case "anbieter": include($customer."anbieter.php");  break;
        case "serverstatus": include($customer."server.php");  break;
        case "news": include($customer."news.php");  break;
        case "changelog": include($customer."changelog.php");  break;

        case "affiliate": include($affiliate."index.php");  break;
        case "affiliate_view": include($affiliate."dashboard.php");  break;

        case "ts3musikbot_create": include($ts3musikbot."create.php");  break;
        case "ts3musikbot_list": include($ts3musikbot."list.php");  break;
        case "ts3musikbot_view": include($ts3musikbot."view.php");  break;

        case "ticket_list": include($ticket."list.php");  break;
        case "ticket_view": include($ticket."view.php");  break;

        //team
        case "admin_users": include($admin."users.php");  break;
        case "admin_user": include($admin."user.php");  break;

        case "admin_bots": include($admin."bots.php");  break;
		case "ts3musikbot_view_admin": include($ts3musikbot."view_admin.php");  break;

        case "admin_tickets": include($ticket."list_admin.php");  break;
		case "admin_ticket_view": include($ticket."view_admin.php");  break;

        case "admin_dashboard": include($admin."dashboard.php");  break;

    }

    if(strpos($currPage,'system_') !== false) {} else {
        include BASE_PATH.'/resources/additional/footer.php';
    }

} else {
    die('please enable .htaccess on your server');
}