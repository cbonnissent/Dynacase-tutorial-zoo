<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eric
 * Date: 12/10/12
 * Time: 14:17
 * To change this template use File | Settings | File Templates.
 */
class WSimpleTest extends WBasicTest
{

    const outdated = "wdt_outdated"; # N_("wdt_outdated")
    const Tarchive = "wdt_archive"; # N_("wdt_archive")
    public function postConstructor() {

        $this->transitions[self::Tarchive]=array();
        $this->cycle[]=array("e1"=>WBasicTest::published,
        "e2"=>self::outdated,
        "t"=>self::Tarchive);

        $this->stateactivity[WBasicTest::published]="wdt_verifyUpToDate";
    }
}
