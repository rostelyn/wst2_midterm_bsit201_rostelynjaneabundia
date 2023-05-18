<?php
require_once('../class/class.account.php');
require_once('../class/class.messages.php');

$accounts = new Accounts;
$messages = new Messages;

if($_GET['ind'] == 'login'){
    $accounts->login();
}

if($_GET['ind'] == 'send'){
    echo $messages->send();
}

if($_GET['ind'] == 'refresh'){
    echo $messages->refresh();
}