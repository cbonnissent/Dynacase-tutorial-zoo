<?php

namespace ZOO;
use \Dcp\AttributeIdentifiers\Zoo_demandeadoption as MyAttributes;
use \Dcp\AttributeIdentifiers as Attributes;
use \Dcp\Family as Family;

Class Zoo_demandeadoption extends \Dcp\Family\Document
{

    function postCreated()
    {
        $err = '';
        if ($this->revision == 0) {
            $err = $this->setReference();
        }
        return $err;
    }
    /**
     * set unique reference
     */
    function setReference()
    {
        $this->setValue(MyAttributes::de_reference, $this->getCurSequence());
        $err = $this->store();
        
        return $err;
    }
    /**
     * constraint to verify entrance date and birth date
     */
    function verifyDate($date)
    {
        $err = '';
        $sug = array();
        $t1 = stringDateToJD($date);
        
        if ($t1 > stringDateToJD($this->getDate())) {
            $err = _("birthday date must be set before today");
        }
        if ($err != "") {
            $sug[] = $this->getDate();
        }
        return array(
            "err" => $err,
            "sug" => $sug
        );
    }
    /**
     * @templateController
     */
    function de_mail_transmitted()
    {
        $s = new \SearchDoc($this->dbaccess, Family\Zoo_animal::familyName);
        $s->addFilter(sprintf("%s = '%d'", Attributes\Zoo_animal::an_espece, $this->getRawValue(Aself::de_idespece)));
        $t = $s->search();
        
        $this->lay->setBlockData("ANIMALS", $t);
        $this->viewdefaultcard();
    }

}
?>