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
/***** theZoo WebUI Settings */
$cfg["webui"]["allow_payload"]   = true;        // Allow payload urls (direct unpacked binaries)
$cfg["webui"]["allow_dbupdate"]  = false;       // Allow to update the malware db over internet
$cfg["webui"]["allow_public"]    = false;       // Allow other than private IP ranges
$cfg["webui"]["allow_extraio"]   = true;        // Do not try to minimize I/O operations

/***** theZoo Settings */
// theZoo Path
$cfg["thezoo"] = "./theZoo";

// theZoo DB
$cfg["db"] = array(
    "engine"   => "sqlite3",
    "dbname"   => "maldb.db",
    "username" => false,
    "password" => false,
);

?>