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
// Require files for operation
require_once("config.inc.php");
require_once("functions.inc.php");

// Very first thing we do is to make sure is if we are local or not
// We only care about if we are not!
if ( isLocalIP() === false ) {
  // Do we really care about this?
  if ( $cfg["webui"]["allow_public"] === false ) {
    $msg = "<html><body><h2>theZoo WebUI</h2>Sorry but this website's core functionality is currently locked down to only allow private IP ranges.</body></html>";
    sendHTTPcode(403,$msg,true); // Send Forbidden and terminate connection
  }
}

$page_malwarelist = "<table id=\"malwareOverview\" border=\"0\">\n" .
                    " <tr class=\"theader\">\n" .
                    "<th>Name</th>\n" .
                    "<th>Type</th>\n" .
                    "<th>From</th>\n" .
                    "</tr>\n";
$db = new SQLite3(rtrim($cfg["thezoo"],"/")."/conf/maldb.db");
$results = $db->query('SELECT * FROM Malwares ORDER BY Name COLLATE NOCASE ASC');
while ($row = $results->fetchArray()) {
  $page_malwarelist .=  "<tr class=\"malwareLine\" onClick=\"window.location='/?page=malware&id=".intval(trim($row["ID"]))."'\">\n" .
                        " <td><a href=\"/?page=malware&id=".intval(trim($row["ID"]))."\">".htmlentities($row["NAME"])."</a></td>\n" .
                        " <td>".htmlentities($row["TYPE"])."</td>\n" .
                        " <td>".htmlentities($row["DATE"])."</td>\n" .
                        "</tr>\n";
}
$page_malwarelist .= "</table>\n";

$page_404 = "<h3>Ouch, sorry page not found!</h3>".
            "<p>This project is still very heavily under development, so there will be pages missing :)</p>".
            "<p>New features are being added all the time, please try again later ...</p>";




if ( array_key_exists("page",$_GET) ) $pageShow = trim($_GET["page"]);
else $pageShow = false;

switch($pageShow) {
  case "home":
    if (isset($page_malwarelist) ) $page = $page_malwarelist;
    else $page = $page_404;
    break;
  case "update":
    if (isset($page_update) ) $page = $page_update;
    else $page = $page_404;
    break;
  case "links":
    if (isset($page_links) ) $page = $page_links;
    else $page = $page_404;
    break;
  case "about":
    if (isset($page_about) ) $page = $page_about;
    else $page = $page_404;
    break;
  case "malware":
    if (isset($page_malware) ) $page = $page_malware;
    else $page = $page_404;
    break;
  default:
    if (isset($page_malwarelist) ) $page = $page_malwarelist;
    else $page = $page_404;
    break;
}

// Crude way to check for theZoo EULA
// But doing it here to show "more pretty page about it..."
// Should be done higher up and perhaps "die"...
if ( checkEULA() === false ) {
  // We simply overrule the page !!
  // But mind, anything done above will still be executed/run
  $page = "<h3>Hi! Even though the zoo is open!</h3>".
          "<p>You need to accept theZoo EULA!</br>This site won't work until you do so :)</p>";
}

?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>theZoo WebUI</title>
  <meta name="description" content="theZoo WebUI for your homelab">
  <meta name="author" content="KawaiiPantsu">

  <meta property="og:title" content="theZoo WebUI">
  <meta property="og:type" content="website">
  <meta property="og:description" content="theZoo WebUI for your homelab">

  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <script src="/js/jquery-3.6.1.min.js"></script>

</head>
<body>
  <div class="siteTitle">
        <div class="line1">theZoo <img src="/images/icons/virus.png" class="siteIcon" /> WebUI</div>
        <div class="line2">malware.db.<?=dbVersion()?></div>
    </div>
  <div class='menu'>
  <span class='toggle'>
    <i></i>
    <i></i>
    <i></i>
  </span>
  <div class='menuContent'>
    <ul>
      <li><a href="/"><img src="/images/icons/house2.png" class="menuicon" /> Home</a></li>
      <li><a href="/?page=update"><img src="/images/icons/db_full.png" class="menuicon" /> Update</a></li>
      <li><a href="/?page=links"><img src="/images/icons/lighthouse.png" class="menuicon" /> Links</a></li>
      <li><a href="/?page=about"><img src="/images/icons/speaker.png" class="menuicon" /> About</a></li>
    </ul>
  </div>
  </div>
  <div class="pageContainer shadowBorder">
    <div class="pageContent">
      <?=$page?>
    </div>
  </div>
  <div class='backgroundImg'></div>
  <script src="js/scripts.js"></script>
</body>
</html>
