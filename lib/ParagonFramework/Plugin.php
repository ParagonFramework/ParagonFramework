<?php

function getGITCommit() {
    $git_dir = "plugins/ParagonFramework";
    $git_head = file_get_contents("$git_dir/.git/HEAD");
    $git_headHash = "<not available>";
    $git_headLink = "https://193.170.192.154/pimcore-org/ParagonFramework";

    if (preg_match("#ref: refs/heads/(\\w+)#", $git_head, $git_head)) {
        $git_headHash = file_get_contents("$git_dir/.git/refs/heads/$git_head[1]");
        $git_headLink = "$git_headLink/commit/$git_headHash";
        $git_headHash = substr($git_headHash, 0, 8);
    }

    $git_info = new stdClass();
    $git_info->Head = $git_head[1];
    $git_info->Link = $git_headLink;
    $git_info->Hash = $git_headHash;

    return $git_info;
}

class ParagonFramework_Plugin  extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {
    public static $GITCommit;

    public static function install (){
        // implement your own logic here
        return true;
    }

    public static function uninstall (){
        // implement your own logic here
        return true;
    }

    public static function isInstalled () {
        // implement your own logic here
        return true;
    }

}

ParagonFramework_Plugin::$GITCommit = getGITCommit();
