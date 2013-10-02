<?php
class pen{
    public function __construct($name){
        $this->user = "lmm";
        $this->name=$name;
    }
    public function __tostring(){
        return $this->name."(".$this->user;
    }
}
$cls = new pen("134");
echo $cls;
