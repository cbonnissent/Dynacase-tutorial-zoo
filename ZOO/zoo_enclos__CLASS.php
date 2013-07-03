<?php

namespace ZOO;
use \Dcp\AttributeIdentifiers\Zoo_enclos as MyAttributes;

Class Zoo_enclos extends \Dcp\Family\Document
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
        if ($nb == intval($this->getRawValue(MyAttributes::en_capacite))) return _("zoo:Full Area");
        elseif ($nb > intval($this->getRawValue(MyAttributes::en_capacite))) return (sprintf(_("zoo:Maximum Capacity reached %d > %d") , $nb, intval($this->getRawValue(MyAttributes::en_capacite))));
        return '';
    }
    /**
     * return count of animals
     * @return int
     */
    public function getNbreAnimaux()
    {
        return count($this->getMultipleRawValues(MyAttributes::en_animaux));
    }
    /**
     * default view for enclos to see animal's photo
     * @templateController
     * @return void
     */
    function viewenclos($target = "_self", $ulink = true, $abstract = false)
    {
        $this->viewdefaultcard($target, $ulink, $abstract);
        
        $anidT = $this->getMultipleRawValues(MyAttributes::en_animaux);
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
?>