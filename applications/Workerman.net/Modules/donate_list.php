<?php
namespace WorkerMan\Modules;

function donate_list()
{
    $html_title = '捐赠列表';
    $html_nav = 'donate';
    include NET_ROOT . '/Views/header.tpl.php';
    include NET_ROOT . '/Views/donate_list.tpl.php';
    include NET_ROOT . '/Views/footer.tpl.php';
}

