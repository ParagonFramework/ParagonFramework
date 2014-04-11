<?php


class ParagonFramework_IndexController extends Pimcore_Controller_Action_Admin {

	public function indexAction() {

        $pcw = new ParagonFramework_PimcoreWrapper();
        $user=$pcw->getUserByName("localhorst");
        $b1=$user->hasPermission("qr_codes");
        $b2=$user->hasPermission("notes_events");

        if($b1===true)
            echo("b1 is true");

        if($b2==false)
            echo("b2 is false");


		// reachable via http://your.domain/plugin/ParagonFramework/index/index
	}
}
