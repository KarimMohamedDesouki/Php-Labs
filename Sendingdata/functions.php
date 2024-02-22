<?php

function submit_to_file($name,$email){
    $fp = fopen(SUBMIT_FILE,"a+");
    if($fp){
        $input = date("Y-m-d H:i:s").";".$_SERVER['HTTP_USER_AGENT'].";".$name.";".$email.PHP_EOL;
        if(fwrite($fp,$input)){
            fclose($fp);
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    echo '<br>';
}


function display_submits(){
    $lines = file(SUBMIT_FILE);
    foreach($lines as $line){
        echo "<h1>New User Deatils</h1>";
        $words = explode(";",$line);
        $i = 0;
        foreach($words as $word){
            if($i == 0){
                echo("<h5>Date: $word</h5>");
            }elseif($i == 1){
                echo("<h5>Browser: $word</h5>");
            }elseif($i == 4){
                echo("<h5>Name: $word</h5>");
            }elseif($i == 5){
                echo("<h5>Email: $word</h5>");
            }
            
            $i++;
        }
        echo '<br>';    
    }
}





?>