<?php


class ParagonFramework_IndexController extends Pimcore_Controller_Action_Admin {

    function printFancy($i, $a) {
        echo "$i = " . ($a ? 'true' : 'false') . PHP_EOL;
    }
	public function indexAction() {

        $pcw = new ParagonFramework_PimcoreWrapper();
        $user=$pcw->getUserByName("localhorst");
        $b1=$user->hasPermission("qr_codes");
        $b2=$user->hasPermission("horstiborsti");

        $this->printFancy("qr_codes", $b1);
        $this->printFancy("horstiborsti", $b2);


		// reachable via http://your.domain/plugin/ParagonFramework/index/index
	}
}
