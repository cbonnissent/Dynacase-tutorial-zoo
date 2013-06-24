<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package ZOO
*/
/**
 * Adoption comportment
 *
 */

namespace Zoo;
use \Dcp\AttributeIdentifiers as Da;
use \Dcp\Family as Df;
use \Dcp\AttributeIdentifiers\Zoo_demandeadoption as Aself;

class Adoption extends Df\Document
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
        $this->setValue(Aself::de_reference, $this->getCurSequence());
        $err = $this->modify();
        
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
        
        if ($t1 > stringDateToJD($this->getDate())) $err = _("birthday date must be set before today");
        if ($err != "") $sug[] = $this->getDate();
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
        $s = new \SearchDoc($this->dbaccess, Df\Zoo_animal::familyName);
        $s->addFilter(sprintf("%s = '%d'", Da\Zoo_animal::an_espece, $this->getRawValue(Aself::de_idespece)));
        $t = $s->search();
        
        $this->lay->setBlockData("ANIMALS", $t);
        $this->viewdefaultcard();
    }
}
?>