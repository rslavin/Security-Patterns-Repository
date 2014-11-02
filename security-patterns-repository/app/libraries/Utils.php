<?php

/**
 * Utils
 *  Returns true if the client's ip address is on the 
 *  UTSA network, False otherwise.
 */
class Utils {
    public static function isUTSA(){

        $ip = Request::getClientIp();
        $allowed = '/^129\.115/';

        if(preg_match($allowed, $ip) != 1)
            return false;
        return true;
    }
}
?>
