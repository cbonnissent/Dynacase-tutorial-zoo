<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
*/
/**
 * Gate comportment
 *
 * @author Anakeen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package ZOO
 */


namespace Zoo;
use \Dcp\AttributeIdentifiers as Da;
use \Dcp\AttributeIdentifiers\Zoo_enclos as Aself;
use \Dcp\Family as Df;
class Enclos extends Df\Document
{
    public $defaultview = "ZOO:VIEWENCLOS";
    
    public function preRefresh()
    {
        $msg = $this->detectMaxCapacity();
        return $msg;
    }
    /**
     * verify capacity
     * @return string error message if maximum capacity reached
     */
    public function detectMaxCapacity()
    {
        $nb = $this->getNbreAnimaux();
        if ($nb == intval($this->getRawValue(Aself::en_capacite))) return _("zoo:Full Area");
        elseif ($nb > intval($this->getRawValue(Aself::en_capacite))) return (sprintf(_("zoo:Maximum Capacity reached %d > %d") , $nb, intval($this->getRawValue(Aself::en_capacite))));
        return '';
    }
    /**
     * return count of animals
     * @return int
     */
    public function getNbreAnimaux()
    {
        return count($this->getMultipleRawValues(Aself::en_animaux));
    }
    /**
     * default view for enclos to see animal's photo
     * @templateController
     * @return void
     */
    function viewenclos($target = "_self", $ulink = true, $abstract = false)
    {
        $this->viewdefaultcard($target, $ulink, $abstract);
        
        $anidT = $this->getMultipleRawValues(Aself::en_animaux);
        $anid = array();
        foreach ($anidT as $cle => $val) {
            $anid[] = array(
                "anid" => $val
            );
        }
        
        $this->lay->setBlockData("PHOTO", $anid);
    }

    /**
     * @templateController
     * @param string $target
     * @param bool $ulink
     * @param bool $abstract
     */
    function enclos($target = "_self", $ulink = true, $abstract = false)
    {
        //$this->viewdefaultcard($target,$ulink,$abstract);
        $t[] = array(
            "V_VALEUR" => "1",
            "V_ISTEST" => true
        );
        $t[] = array(
            "V_VALEUR" => "2",
            "V_ISTEST" => false
        );
        $this->lay->set("TODAY", $this->getDate());
        $this->lay->setBlockData("", $t);
    }

}