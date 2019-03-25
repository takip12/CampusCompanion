<?php

if (empty($_POST['page'])){

    $display_type = 'no-signin';

    include ('view_start.php');
    exit();
}

session_start();

require('model.php');

if($_POST['page'] == 'StartPage'){

    $command = $_POST['command'];
    
    switch($command){
        /*
        case 'SignIn':
            if(!is_valid($_POST['username'], $_POST['password'])){
                $error_msg_username = 'Wrong username or';
                $error_msg_password = 'Wrong password';

                $display_type = 'signin';

                include('view_start.php');
            }else{
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $_POST['username'];
                $username = $_POST['username'];
                include ('view_main.php');
            }
            exit();
        
        case 'Join':
            if(does_exist($_POST['username'])){
                $error_msg_username = 'The user exists';
                $error_msg_password = '';
                $display_type = 'join';
                include('view_start.php');
            }else{
                if(insert_new_user($_POST['username'], $_POST['password'], $_POST['email'])){
                    $error_msg_username = '';
                    $error_msg_password = '';
                    $display_type - 'signin';
                    include('view_start.php');
                }else{
                    $error_msg_username = 'Insertion error';
                    $error_msg_password = '';
                    $display_type = 'join';
                    include('view_start.php');
                }
            }
            exit();
*/
        case 'ListTopics':
            list_topics();
            //list_topics($_POST['searchT']);
            break;

            case 'ListMembers':
            list_members($_POST['searchT']);
            break;
    }
}

else if ($_POST['page'] == 'MainPage'){
    
    $command = $_POST['command'];

    switch($command){
        case 'SignOut' :
            session_unset();
            session_destroy();

            $display_type = 'no-signin';
            include('view_start.php');
            break;

        default:
            echo 'Unknown command - ' . $command . '<br>';
    }
}

else {
    
}

?>