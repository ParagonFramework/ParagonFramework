<?php

if (!defined("PLUGINS_CONFIGURATION_DIRECTORY"))  define("PLUGINS_CONFIGURATION_DIRECTORY", PIMCORE_WEBSITE_VAR . "/plugins");

function getGITCommit() {
	$git_dir = "plugins/ParagonFramework";
	$git_head = file_get_contents("$git_dir/.git/HEAD");
	$git_headHash = "<not available>";
	$git_headLink = ParagonFramework_Plugin::$GITHubURL;

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

class ParagonFramework_Plugin extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {
    public static $GITCommit;
    public static $GITHubURL;
    public static $GITHubOrgURL;

    /**
     *
     * @var ParagonFramework_Plugin $_instance
     */
    static private
        $_instance;

    /**
     *
     * @return ParagonFramework_Plugin
     */
    public static function getInstance() {
        if(!(self::$_instance instanceof ParagonFramework_Plugin)) {
            self::$_instance = new ParagonFramework_Plugin();
        }

        return self::$_instance;
    }

	public static function install() {
        $plugin = ParagonFramework_Plugin::getInstance();
        $plugin->ensureFolder();
        $plugin->deployPlugin();

        return $plugin->statusFolder();
	}

	public static function uninstall() {
        $plugin = ParagonFramework_Plugin::getInstance();
        $plugin->deleteFolder();

		// implement your own logic here
		// return file_exists($filePath);
        return $plugin->statusFolder() == false;
	}

	public static function isInstalled() {
        $plugin = ParagonFramework_Plugin::getInstance();

		// implement your own logic here
		return $plugin->statusFolder();
	}

    private
        $deployFolderPath,
        $templateFolderPath;

    public function __construct() {
        $this->templateFolderPath = PIMCORE_PLUGINS_PATH . "/ParagonFramework";
        $this->deployFolderPath = PIMCORE_WEBSITE_VAR . "/plugins" . "/ParagonFramework";
    }

    public function getDeployPath() {
        return $this->deployFolderPath;
    }

    public function ensureFolder() {
        if ($this->statusFolder() == false) {
            mkdir($this->deployFolderPath, 0777, true);
        }
    }

    public function deleteFolder() {
        if($this->statusFolder()) {
            unlink($this->deployFolderPath . "/config.json");
            rmdir($this->deployFolderPath);
        }
    }

    public function statusFolder() {
        return file_exists($this->deployFolderPath);
    }

    public function deployPlugin() {
        copy($this->templateFolderPath . "/static/json/config.json", $this->deployFolderPath . "/config.json");
    }
}

ParagonFramework_Plugin::$GITHubOrgURL = "https://github.com/orgs/ParagonFramework/people";
ParagonFramework_Plugin::$GITHubURL = "https://github.com/ParagonFramework/ParagonFramework";
ParagonFramework_Plugin::$GITCommit = getGITCommit();
