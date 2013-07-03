<?php

namespace ZOO;
use \Dcp\AttributeIdentifiers\Zoo_classe as MyAttributes;
use \Dcp\AttributeIdentifiers as Attributes;

Class Zoo_classe extends \Dcp\Family\Document
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
     * @templateController
     */
    public function viewordonnance($target = "_self", $ulink = true, $abstract = false)
    {
        $idveto = \Action::getArgument('ca_idveterinaire');
        $idanimal = \Action::getArgument('ca_idnom');
        $dateveto = \Action::getArgument('ca_date');
        $desc = \Action::getArgument('ca_description');
        /**
         * @var \Dcp\Family\Zoo_Veterinaire $doc
         */
        $doc = new_Doc($this->dbaccess, $idveto);
        $this->lay->set("us_lname", $doc->getRawValue(Attributes\Zoo_veterinaire::us_lname));
        $this->lay->set("us_fname", $doc->getRawValue(Attributes\Zoo_veterinaire::us_fname));
        
        $this->lay->set("dateveto", $dateveto);
        $this->lay->set("v_desc", $desc);
        $docAnimal = new_Doc($this->dbaccess, $idanimal);
        $this->lay->set("an_nom", $docAnimal->getRawValue(Attributes\Zoo_animal::an_nom));
    }
    /**
     * carnet de sante
     * view resume of diseases
     * @templateController
     */
    public function maladie($target = "_self", $ulink = true, $abstract = false)
    {
        
        $this->lay->set("today", $this->getDate());
        $animal = new_doc($this->dbaccess, $this->getRawValue("ca_idnom"));
        if ($animal->isAlive()) {
            $this->lay->set("animal_name", $animal->getRawValue(Attributes\Zoo_animal::an_nom));
            $this->lay->set("espece", $animal->getHTMLAttrValue(Attributes\Zoo_animal::an_espece) , $target, $ulink);
            $this->lay->set("classe", $animal->getHTMLAttrValue(Attributes\Zoo_animal::an_classe) , $target, $ulink);
            $this->lay->set("tatouage", $animal->getRawValue(Attributes\Zoo_animal::an_tatouage));
            $this->lay->set("n", count($this->getMultipleRawValues(Attributes\Zoo_carnetsante::ca_date)));
        } else {
            addWarningMsg(_("zoo:the animal document is not found"));
        }
        
        $vetos = $this->getMultipleRawValues(Attributes\Zoo_carnetsante::ca_idveterinaire);
        if (count($vetos) > 0) {
            $vetoid = $vetos[0];
            $veto = new_doc($this->dbaccess, $vetoid);
            if ($veto->isAlive()) {
                $this->lay->set("vetoname", $veto->getRawValue(Attributes\Zoo_veterinaire::us_fname) . ' ' . $veto->getRawValue(Attributes\Zoo_veterinaire::us_lname));
            } else {
                addWarningMsg(_("zoo:the veto document is not found"));
            }
        }
    }

}
?>