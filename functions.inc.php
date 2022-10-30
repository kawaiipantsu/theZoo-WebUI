<?php
/****
  _   _          _____             ______        __   _     _   _ ___ 
 | |_| |__   ___|__  /___   ___   / / /\ \      / /__| |__ | | | |_ _|
 | __| '_ \ / _ \ / // _ \ / _ \ / / /  \ \ /\ / / _ \ '_ \| | | || | 
 | |_| | | |  __// /| (_) | (_) / / /    \ V  V /  __/ |_) | |_| || | 
  \__|_| |_|\___/____\___/ \___/_/_/      \_/\_/ \___|_.__/ \___/|___|
                                                   by KawaiiPantsu
 https://github.com/kawaiipantsu/theZoo-WebUI

***************************************************************************/
// Functions for simplification

function sendHTTPcode($code=false,$text="",$terminate=false) {
   if ( $code && is_int($code) ) {
    http_response_code($code);
    if ($terminate) die($text);
   } 
}

function isLocalIP() {
    $remote_ip = trim($_SERVER["REMOTE_ADDR"]);
    if ( ! filter_var($remote_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) ) return true;
    else return false;
}

function dbVersion() {
    global $cfg;
    $theZooVer = rtrim($cfg["thezoo"],"/")."/conf/db.ver";
    if (is_file($theZooVer) && is_readable($theZooVer) ) {
        $ver = file_get_contents($theZooVer);
        return trim($ver);
    } else return "";
}

function dbVersionLatest() {
    global $cfg;
    $theZooVer = rtrim($cfg["thezoo"],"/")."/conf/db.ver";
    if (is_file($theZooVer) && is_readable($theZooVer) ) {

    } else {

    }
}

function checkEULA() { 
    global $cfg;
    $theZooEULA = rtrim($cfg["thezoo"],"/")."/conf/eula_run.conf";
    if (is_file($theZooEULA) && is_readable($theZooEULA) ) return true;
    else return false;
}

?>