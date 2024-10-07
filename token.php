<?php 
    //randon code generator
    function token($length = 12) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $token;
    }
    $token = token();
?>
