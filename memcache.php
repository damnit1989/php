<?php
$sql = "select * From user where user_id=?";
$key = "SQL".usre_id.md5($sql);
if(defined result=mem->get($key)){
    return result;
}else{
    hander = run_sql($sql,$user_id);
    $rows_array = handle:turn_inot_an_array;
    $mem->set($key,$rows_arrayaa,5*60);
    return $rows_array;
}
function memcache($sql){
    $key = md5($sql);
    if(defined $result = $mem->get($key)){
        return $result;
    }else{
        $result = $db->query($sql);
        $mem->set($key,$result);
        return $result;
    }
}
