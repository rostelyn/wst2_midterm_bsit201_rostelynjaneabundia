<?php
class Messages{
    public function send(){
        session_start();
        $message = $_POST['message'];
        $id = $_SESSION['auth'][0]['id'];

        $pdo = new PDO('mysql:host=localhost;dbname=bsit201_abundia_chatroom','root','');

        $messages = $pdo->prepare('INSERT INTO messages(account_id,message) VALUES (:account_id,:message)');
        $messages->bindValue('account_id',$id);
        $messages->bindValue('message',$message);
        $messages->execute();
    }

    public function refresh(){
        session_start();

        $id = $_SESSION['auth'][0]['id'];

        $pdo = new PDO('mysql:host=localhost;dbname=bsit201_abundia_chatroom','root','');

        $messages = $pdo->prepare('SELECT m.id,m.message,m.timestamp,a.name,m.account_id FROM `messages` as m INNER JOIN accounts as a ON a.id = m.account_id;');
        $messages->execute();

        $data = $messages->fetchAll();

        foreach($data as $message){
            if($id == $message['account_id']){
                echo '
                    <div class="you">
                        <div>
                            <p>You</p>
                            <p>'.$message['message'].'</p>
                        </div>
                    </div>
                ';
            }else{
                echo '
                    <div class="others">
                        <div>
                            <p>'.$message['name'].'</p>
                            <p>'.$message['message'].'</p>
                        </div>
                    </div>
                ';
            }

            
        }
    }
}