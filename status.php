<?php
require "connection.php";
    $sql="select * from polls";
    $rs=$db->prepare($sql);
    $rs->execute();
    $curent_date= date('Y-m-d H:i:s');
    $status="";

    while($row=$rs->fetch()){
        $poll_date=$row['expires_at'];
        $poll_id=$row['poll_id'];
        if($curent_date > $poll_date && isset($poll_date)){
            $change=$db->prepare("UPDATE `polls` SET `is_active` = 0 WHERE `polls`.poll_id = $poll_id");
            $change->execute();
            $status="closed";
    }
    else if($curent_date < $poll_date && isset($poll_date))
        {
            $change=$db->prepare("UPDATE `polls` SET `is_active` = 1 WHERE `polls`.poll_id = $poll_id");
            $change->execute();
            $status="open";
        }

}


?>