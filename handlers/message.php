<?php

include "../config.php";

    switch ($_REQUEST['action']) {
        case "sendMessage":
            session_start();
                $quary = $con->prepare("INSERT INTO messages SET user=? , message=?");
              $run =  $quary->execute([$_SESSION['username'], $_REQUEST['message']]);
            
            if( $run )
            {
                echo 1;
                exit;
            }
              break;
            case "getMessages":
                $quary = $con->prepare("SELECT * from messages");
                $run =  $quary->execute();

                $result = $quary->fetchAll(PDO::FETCH_OBJ);

                $chat = "";
                foreach($result as $message)
                {
                    $chat .= '<div class="single-message">
                    <strong>'.  $message->user   .':</strong> ' .  $message->message .'
                    <span>'. date( 'h:i a'   ,strtotime( $message->date ))   .'</span>
                    </div>';
                }

                foreach($result as $message)
                {
                    $chat .= '<div class="single-message">
                    <strong>'.  $message->user   .':</strong> ' .  $message->message .'
                    <span>'. date( 'h:i a'   ,strtotime( $message->date ))   .'</span>
                    </div>';
                }

                foreach($result as $message)
                {
                    $chat .= '<div class="single-message">
                    <strong>'.  $message->user   .':</strong> ' .  $message->message .'
                    <span>'. date( 'h:i a'   ,strtotime( $message->date ))   .'</span>
                    </div>';
                }

               
                echo $chat;

                
                break;

                
            }

?>