<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
*/
/**
 * Adoption comportment
 *
 * @author Anakeen 2010
 * @version $Id: Method.Adoption.php,v 1.4 2011-02-01 16:40:08 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 */
/**
 */
/**
 * @begin-method-ignore
 * this part will be deleted when construct document class until end-method-ignore
 */
Class _ZOO_ADOPTION extends Doc
{
    /*
     * @end-method-ignore
    */
    function postCreated()
    {
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
        $this->setValue("de_reference", $this->getCurSequence());
        $err = $this->modify();
        
        return $err;
    }
    /**
     * constraint to verify entrance date and birth date
     */
    function verifyDate($date)
    {
        $t1 = stringDateToJD($date);
        
        if ($t1 > stringDateToJD($this->getDate())) $err = _("birthday date must be set before today");
        if ($err != "") $sug[] = $this->getDate();
        return array(
            "err" => $err,
            "sug" => $sug
        );
    }
    
    function de_mail_transmitted()
    {
        include_once ("FDL/Class.SearchDoc.php");
        
        $s = new SearchDoc($this->dbaccess, "ZOO_ANIMAL");
        $s->addFilter(sprintf("an_espece = '%d'", $this->getValue("de_idespece")));
        $t = $s->search();
        
        $this->lay->setBlockData("ANIMALS", $t);
        $this->viewdefaultcard();
    }
    /**
     * @begin-method-ignore
     * this part will be deleted when construct document class until end-method-ignore
     */
}
/*
 * @end-method-ignore
*/
?>