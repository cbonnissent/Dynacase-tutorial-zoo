<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
*/
/**
 * Carnet comportment
 *
 * @author Anakeen 2010
 * @version $Id: Method.Carnet.php,v 1.4 2010-04-20 07:55:44 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 */
/**
 */
/**
 * @begin-method-ignore
 * this part will be deleted when construct document class until end-method-ignore
 */
Class _ZOO_CARNET extends Doc
{
    /*
     * @end-method-ignore
    */
    public $cviews = array(
        "ZOO:VIEWORDONNANCE"
    );
    //test de code
    public function getTime()
    {
        return strftime("%T", time());
    }
    /**
     * carnet de sante
     * display new ordonnance
     */
    public function viewordonnance($target = "_self", $ulink = true, $abstract = false)
    {
        $idveto = Action::getArgument('ca_idveterinaire');
        $idanimal = Action::getArgument('ca_idnom');
        $dateveto = Action::getArgument('ca_date');
        $desc = Action::getArgument('ca_description');
        
        $doc = new_Doc($this->dbaccess, $idveto);
        $this->lay->set("us_lname", $doc->getRawValue("us_lname"));
        $this->lay->set("us_fname", $doc->getRawValue("us_fname"));
        
        $this->lay->set("dateveto", $dateveto);
        $this->lay->set("v_desc", $desc);
        $docAnimal = new_Doc($this->dbaccess, $idanimal);
        $this->lay->set("an_nom", $docAnimal->getRawValue("an_nom"));
    }
    /**
     * carnet de sante
     * view resume of diseases
     */
    public function maladie($target = "_self", $ulink = true, $abstract = false)
    {
        
        $this->lay->set("today", $this->getDate());
        $animal = new_doc($this->dbaccess, $this->getRawValue("ca_idnom"));
        if ($animal->isAlive()) {
            $this->lay->set("animal_name", $animal->getRawValue("an_nom"));
            $this->lay->set("espece", $animal->getHTMLAttrValue("an_espece") , $target, $ulink);
            $this->lay->set("classe", $animal->getHTMLAttrValue("an_classe") , $target, $ulink);
            $this->lay->set("tatouage", $animal->getRawValue("an_tatouage"));
            $this->lay->set("n", count($this->getMultipleRawValues("ca_date")));
        } else {
            addWarningMsg(_("zoo:the animal document is not found"));
        }
        
        $vetos = $this->getMultipleRawValues("ca_idveterinaire");
        if (count($vetos) > 0) {
            $vetoid = $vetos[0];
            $veto = new_doc($this->dbaccess, $vetoid);
            if ($veto->isAlive()) {
                $this->lay->set("vetoname", $veto->getRawValue("us_fname") . ' ' . $veto->getRawValue("us_lname"));
            } else {
                addWarningMsg(_("zoo:the veto document is not found"));
            }
        }
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
