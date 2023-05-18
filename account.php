<?php
 
class Accounts{
    public function login(){
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $pdo = new PDO('mysql:host=localhost;dbname=chatroom','root','');

        $account = $pdo->prepare('SELECT * FROM accounts WHERE username=:username and password=:password');
        $account->bindValue('username',$username);
        $account->bindValue('password',$password);
        $account->execute();

        $data = $account->fetchAll(PDO::FETCH_ASSOC);

        if(count ($data) == 1){
            echo 'success';
            $_SESSION['auth'] = $data;
        }else{
            echo 'error';
        }
    }

    public function register(){
        
    }
}