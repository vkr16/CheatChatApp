<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
$username = $_SESSION['user'];
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'paw';

    $link = mysqli_connect($host,$user,$pass, $db) or die(mysqli_error);
if (!isset($_POST['message']))
{
    $message = "";
}
else
{

    $message = $_POST['message'];

    if ($message != "")
    {
        $code = $_POST['code'];
        $sql = "INSERT INTO chats (secretcode,username,message) VALUES('$code','$username','$message')";
        mysqli_query($link, $sql);
    }

}
$code = $_POST['code'];
$sql = "SELECT * FROM chats WHERE secretcode = '$code' ORDER BY id DESC";
if ($result = mysqli_query($link, $sql))
{
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result)){

            $theTime = $row['time'];
            $strTime = strtotime($theTime);
            $jam = date('H:i', $strTime);

            $today = new DateTime();
            $today->setTime( 0, 0, 0 ); 

            $match_date = DateTime::createFromFormat( "Y-m-d H:i:s", $theTime );
            $match_date->setTime( 0, 0, 0 );

            $diff = $today->diff( $match_date );
            $diffDays = (integer)$diff->format( "%R%a" ); 

            switch( $diffDays ) {
                case 0:
                    $tgl =  "Today";
                    break;
                case -1:
                    $tgl =  "Yesterday";
                    break;
                default:
                    $tgl =  "";
            }

            if ($row['username'] == $username) {
                echo '<div class="card-text mb-2 mt-1" style="  background-color: #e8e3ff;padding: 15px 15px;margin-left: 40px; border-radius: 15px 15px 1px 15px ;filter: drop-shadow(2px 1px 3px grey);">'.$row['message'].'<br><small class="text-muted" >'.$tgl.'&nbsp;'.$jam.'</small></div>';
            }else{
                echo '<div class="card-text mb-2 mt-1" style="background-color: #fbfbfb;padding: 10px 15px;margin-right: 40px; border-radius: 15px 15px 15px 1px;filter: drop-shadow(2px 1px 3px grey);"><p style="color: #916f9a"><strong>'.$row['username'].'<br></strong></p>'.$row['message'].'<br><small class="text-muted" >'.$tgl.'&nbsp;'.$jam.'</small></div>';
            }
        } 
    }
    else
    {
        echo "<p class='text-light'>CheatChat v1.0</p>" ;
    }
}

?>
