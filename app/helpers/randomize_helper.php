<?php
    // Create a random string of length
    function randomString($length = 8) {
        $res  = "";
        $chars_to_use  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars_to_use .= "0123456789";
        $chars_to_use .= "abcdefghijklmnopqrstuvwxyz";
        
        for($i = 0; $i < $length; $i++)
        {
          $number = rand(0, strlen($chars_to_use) - 1);
          $res .= $chars_to_use[$number];
        }
      
        return $res;
    }