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
     * Returns the Singleton Instance of ParagonFramework_Plugin
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
        $plugin->deployFiles();

        return ($plugin->deployedCheck()) ? "Installation Completed and Deployed to '" . $plugin->getDeployPath() . "'" : "Failed";
	}

	public static function uninstall() {
        $plugin = ParagonFramework_Plugin::getInstance();
        $plugin->deleteFiles();

		// implement your own logic here
		// return file_exists($filePath);
        return ($plugin->deployedCheck() == false) ? "Uninstallation Completed" : "Failed";
	}

	public static function isInstalled() {
        $plugin = ParagonFramework_Plugin::getInstance();

		// implement your own logic here
		return $plugin->deployedCheck();
	}

    private
        $_deployFolderPath,
        $_templateFolderPath;

    public function __construct() {
        $this->_templateFolderPath = PIMCORE_PLUGINS_PATH . "/ParagonFramework";
        $this->_deployFolderPath = PIMCORE_WEBSITE_VAR . "/plugins" . "/ParagonFramework";
    }

    /**
     * Returns the Deployment Path (Config Directory) from this Plugin
     * @return string
     */
    public function getDeployPath($suffix = '') {
        return $this->_deployFolderPath . $suffix;
    }

    /**
     * Create the Deployment Folder if necessary
     */
    public function ensureFolder() {
        if (file_exists($this->getDeployPath()) == false) {
            mkdir($this->getDeployPath(), 0777, true);
            mkdir($this->getDeployPath('/templates'), 0777, true);
        }
    }

    /**
     * Delete the Deployment Folder
     */
    public function deleteFiles() {
        if(file_exists($this->getDeployPath())) {
            unlink($this->getDeployPath('/config.json'));
        }
    }

    /**
     * Returns if the Deployment Folder exists
     * @return bool
     */
    public function deployedCheck() {
        return file_exists($this->getDeployPath('/config.json'));
    }

    /**
     * Deploy the Sample Configuration File to the Deployment Folder
     */
    public function deployFiles() {
        copy($this->_templateFolderPath . "/static/json/config.json", $this->getDeployPath('/config.json'));
    }
}

ParagonFramework_Plugin::$GITHubOrgURL = "https://github.com/orgs/ParagonFramework/people";
ParagonFramework_Plugin::$GITHubURL = "https://github.com/ParagonFramework/ParagonFramework";
ParagonFramework_Plugin::$GITCommit = getGITCommit();
