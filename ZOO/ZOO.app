<?php

$app_desc = array(
    "name"        => "ZOO",
    "short_name"  => N_("Zoo"),
    "description"=>N_("Zoo formation"),
    "access_free" => "N",
    "icon"        => "zoo.png",
    "displayable" => "Y",
    "with_frame"  => "Y",
    "childof"     => "ONEFAM"
);

$app_acl = array (
    array(
       "name"               =>"ZOO_MONEY",
       "description"        =>N_("Access to ticket sales")
   )
);

$action_desc = array (
array(
    "name"       =>"ZOO_TICKETSALES",
    "short_name"     =>N_("sum of sales"),
    "acl"        =>"ZOO_MONEY"),
array(
    "name"       =>"ZOO_TEXTTICKETSALES",
    "short_name" =>N_("text sum of sales"),
    "script"    =>"Action.zoo_ticketsales.php",
    "function"  =>"zoo_ticketsales",
    "acl"        =>"ZOO_MONEY"),
array(
    "name"       =>"ZOO_XMLTICKETSALES",
    "short_name" =>N_("xml sum of sales"),
    "script"     =>"Action.zoo_ticketsales.php",
    "function"   =>"zoo_xmlticketsales",
    "acl"        =>"ZOO_MONEY"),
array(
    "name"       =>"ZOO_ANIMALFOLDER",
    "short_name" =>N_("animal folder"),
    "script"    =>"Action.zoo_animalfolder.php",
    "function"    =>"zoo_animalfolder",
    "acl"        =>"ONEFAM"),
array(
    "name"       =>"ZOO_COLOR",
    "short_name" =>N_("table colors"),
    "script"     =>"Action.zoo_color.php",
    "function"  =>"zoo_color",
    "acl"        =>"ONEFAM_READ"),
array(
   "name"       =>"ZOO_ROOT",
   "short_name" =>N_("entrance"),
   "acl"        =>"ONEFAM_READ",
   "root"       => "Y"),
array(
   "name"       =>"ONEFAM_ROOT",
   "root"       => "N")
)


/***********
 * Samples *
 ***********/

/*
$app_acl = array(
    array(
        "name"               => "ZOO_MONEY",
        "description"        => N_("Access to ticket sales")
    )
);
*/

/*
$action_desc = array(
    array(
        "name"               => "ZOO_TEXTTICKETSALES",   //required
        "short_name"         => N_("text sum of sales"), //not required
        "script"             => "zoo_ticketsales.php",   //not required, defaults to lower(<name>).php
        "function"           => "zoo_ticketsales",       //not required, defaults to lower(<name>)
        "acl"                => "ZOO_MONEY"              //not required, defaults to null
    )
);
*/

?>
