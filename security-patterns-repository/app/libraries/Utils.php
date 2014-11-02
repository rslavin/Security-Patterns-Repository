<?php

class Utils {
    /**
     * isUTSA
     * Checks if a client is on the UTSA network.
     * @return True if the client is on the UTSA network, false otherwise.
     */
    public static function isUTSA(){

        $ip = Request::getClientIp();
        $allowed = '/^129\.115/';

        if(preg_match($allowed, $ip) != 1)
            return false;
        return true;
    }
}
?>
