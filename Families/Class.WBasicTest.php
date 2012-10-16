<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
 */


class WBasicTest extends WDoc
{
    public $attrPrefix = "WDT";


    public static function i18n()
    {
        return  array(
           /*_ initialised state */
            _("wdt_initialised"),
            /*_ transmited state */
            _("wdt_transmited"),
            /*_ accepted state */
            _("wdt_accepted"),
            /*_ refused state */
            _("wdt_refused"),
            /*_ published state */
            _("wdt_published"),

           /*_ transmition transition */
            _("wdt_transmition"),
            /*_ accept transition */
            _("wdt_accept"),
            /*_ refuse transition */
            _("wdt_refuse"),
            /*_ retry transition */
            _("wdt_retry"),
            /*_ realise transition */
            _("wdt_realise"),

            /*_ redaction activity */
            _("wdt_redaction"),
            /*_  verification activity */
            _("wdt_verification"),
            /*_  realisation activity */
            _("wdt_realisation")
        );
    }

    // state names
    const initialised = "wdt_initialised";
    const transmited = "wdt_transmited";
    const accepted = "wdt_accepted";
    const refused = "wdt_refused";
    const published = "wdt_published";

    // transition names
    const Ttransmition = "wdt_transmition";
    const Taccept = "wdt_accept";
    const Trefused = "wdt_refuse";
    const Tretry = "wdt_retry";
    const Trealise = "wdt_realise";
    public $firstState = self::initialised;


    // activity labels
    public $stateactivity = array(
        self::initialised => "wdt_redaction",
        self::transmited => "wdt_verification",
        self::accepted => "wdt_realisation"
    );

    // transition type
    public $transitions = array(
        self::Ttransmition => array(//  "m0" => "myFirstCondition",
            //  "m1" => "mySecondCondtion",
            //  "m2" => "myFirstProcess",
            //  "m3" => "myLastProcess"
        ),
        self::Taccept => array(

            //  "ask" => array("wdf_levelmax1"),
            "nr" => true),
        self::Trefused => array(
            //  "m1" => "myGlobalTest",
            //  "ask" => array("wdf_globalmax1", "wdf_globalmax2"),
            "nr" => true),
        self::Trealise => array(),
        self::Tretry => array("nr" => true)
    );


    /**
     * @param string $newStep next step id
     * @param string $currentStep current step id
     * @return string error message
     */
    public function myGlobalTest($newStep, $currentStep)
    {
        $err = '';
        $level1 = $this->getInstanceValue("bat_level1");
        $param1 = $this->getValue("wdf_globalmax1"); // here get transition paramter
        $param2 = $this->getValue("wdf_globalmax2"); // here get transition paramter
        if ($level1 > $param1 || $level1 > $param2) {
            $err = sprintf("Level one [%d] must be lesser then  [%d]", $level1, min($param1, $param2));
        }
        return $err;
    }

    /**
     * @param string $newStep next step id
     * @param string $currentStep current step id
     * @return string error message
     */
    public function myFirstCondition($newStep, $currentStep)
    {
        $err = '';
        $level1 = $this->getInstanceValue("bat_level1");
        $level2 = $this->getInstanceValue("bat_level2");
        if ($level1 < $level2) {
            $err = sprintf("Level one [%d] must be greater than level two [%d]", $level1, $level2);
        }
        return $err;
    }

    /**
     * @param string $newStep next step id
     * @param string $currentStep current step id
     * @return string error message
     */
    public function myLevelCondition($newStep, $currentStep)
    {
        $err = '';
        $level1 = $this->getInstanceValue("bat_level1");
        $max1 = $this->getValue("wdf_levelmax1");
        if ($level1 > $max1) {
            $err = sprintf("Level one [%d] must be lesser than max [%d]", $level1, $max1);
        }
        return $err;
    }

    /**
     * @param string $currentStep current step id
     * @param string $previousStep previous step id
     * @return string error message
     */
    public function myFirstProcess($currentStep, $previousStep)
    {
        $level2 = $this->getInstanceValue("bat_level2");
        $err = $this->doc->setValue("bat_level2", $level2 + 1);
        if (!$err) $err = $this->doc->store();
        return $err;
    }

    /**
     * @param string $currentStep current step id
     * @param string $previousStep previous step id
     * @return string error message
     */
    public function myLastProcess($currentStep, $previousStep)
    {
        $err = '';
        $level1 = $this->getInstanceValue("bat_level1");
        $level2 = $this->getInstanceValue("bat_level2");
        $this->doc->addComment(sprintf("Difference level is %d", $level1 - $level2));
        return $err;
    }

    /**
     * @param string $newStep next step id
     * @param string $currentStep current step id
     * @param string $comment transition comment
     * @return string error message
     */
    public function mySecondCondtion($newStep, $currentStep, $comment)
    {
        $err = '';
        $level1 = $this->getInstanceValue("bat_level1");
        $level2 = $this->getInstanceValue("bat_level2");
        if ($level1 < $level2) {
            $err = sprintf("Level one [%d] must be greater than level two [%d]", $level1, $level2);
        }
        return $err;
    }

    public $cycle = array(
        array(
            "e1" => self::initialised,
            "e2" => self::transmited,
            "t" => self::Ttransmition
        ),
        array(
            "e1" => self::transmited,
            "e2" => self::accepted,
            "t" => self::Taccept
        ),
        array(
            "e1" => self::transmited,
            "e2" => self::refused,
            "t" => self::Trefused
        ),
        array(
            "e1" => self::accepted,
            "e2" => self::published,
            "t" => self::Trealise
        ),
        array(
            "e1" => self::transmited,
            "e2" => self::initialised,
            "t" => self::Tretry
        )
    );

    public function getFirstState()
    {
        $u = getCurrentUser();
        $userRole = $u->getAllRoles();
        // test if current user has bigboss role
        foreach ($userRole as $roleProps) {
            if ($roleProps["login"] == "bigboss") {
                return self::accepted;
            }
        }
        return $this->firstState;
    }
}
