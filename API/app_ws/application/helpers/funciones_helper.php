<?php
    function contiene($pajar, $aguja) {
        if ($aguja == '') {
            return true;
        }
        return strpos($pajar, $aguja) !== false;
    }
    function randomPassword() {
        $alphabet = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
