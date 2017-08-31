<?php
/* create on 2013-10-02
 * author lmm
 * this is a function that check the time
 */
function checkTime($send_time,$limit_days){
    $begin_time = date("Y-m-d",strtotime($send_time));
    $end_time = date("Y-m-d");
    $days = 0;
    while($begin_time < $end_time){
        if(!in_array(date("w",strtotime($begin_time)),array('0','1'))){
            $days++;
        }
        echo $days.'<br/>';
        $begin_time = date("Y-m-d",strtotime($begin_time."+1days"));
    }
    if($days <= $limit_days){
        return true;
    }
    return false;
}
if(checkTime('2013-10-1',1)){
    echo 'good';
}else{
    echo 'bad';
}
//this is a test php ,i love it very much
//this is a test i love it very much
