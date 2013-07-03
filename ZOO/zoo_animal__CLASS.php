<?php

namespace ZOO;
use \Dcp\AttributeIdentifiers\Zoo_animal as MyAttributes;
use \Dcp\AttributeIdentifiers as Attributes;
use \Dcp\Family as Family;

Class Zoo_animal extends \Dcp\Family\Document
{
 /**
     * return document identificator of ascendant
     * @param string $sexeVar the sexe of ascendant M or F
     * @return int
     */
    public function getAscendant($sexeVar)
    {
        include_once ("FDL/Class.SearchDoc.php");
        $resultat = " ";
        $s = new \SearchDoc($this->dbaccess, $this->getPropertyValue('fromid'));
        $s->addFilter("an_enfant ~ E'\\\\y%d\\\\y'", $this->getPropertyValue('initid'));
        $s->slice = 3;
        $tdoc = $s->search();
        if (count($tdoc) == 0) return " ";
        foreach ($tdoc as $k => $v) {
            $sexe = getv($v, MyAttributes::an_sexe);
            if ($sexe == $sexeVar) $resultat = $v["initid"];
        }
        
        return $resultat;
    }
    
    public function getAscendant2($sexeVar)
    {
        
        $s = new \SearchDoc($this->dbaccess, $this->getPropertyValue('fromid'));
        $s->addFilter("%s ~ E'\\\\y%d\\\\y'", MyAttributes::an_enfant, $this->getPropertyValue('initid'));
        $s->addFilter("%s = '%s'", MyAttributes::an_sexe, $sexeVar);
        $s->setObjectReturn();
        $s->slice = 1;
        $s->search();
        if ($s->count() == 0) return " ";
        $ani = $s->getNextDoc();
        return $ani->getPropertyValue('initid');
    }
    public function postStore()
    {
        return $this->refreshChilds();
    }
    public function preCreated()
    {
        if ($this->revision == 0) return $this->verifyCapacity();
        return '';
    }
    public function postCreated()
    {
        $err = "";
        if ($this->revision == 0) {
            $err = $this->addToEnclos();
        }
        return $err;
    }
    
    public function addToEnclos()
    {
        $enclosId = $this->getFreeEnclos();
        $err = "";
        if ($enclosId > 0) {
            $enclos = new_doc($this->dbaccess, $enclosId);
            if ($enclos->isAlive()) {
                $enclos->disableEditControl();
                $animals = $enclos->getMultipleRawValues(Attributes\Zoo_enclos::en_animaux);
                array_push($animals, $this->id);
                $err = $enclos->setValue(Attributes\Zoo_enclos::en_animaux, $animals);
                if ($err == "") $err = $enclos->store();
            }
        }
        return $err;
    }
    /**
     * constraint to verify entrance date and birth date
     */
    public function validatePastDate($date)
    {
        if (is_array($date)) return true;
        $t1 = StringDateToUnixTs($date);
        $sug = array();
        $err = "";
        if ($t1 > time()) $err = _("zoo:birthday date must be set before today");
        if ($err != "") $sug[] = $this->getDate();
        return array(
            "err" => $err,
            "sug" => $sug
        );
    }
    /**
     * return first free gate compatible with species
     * @return int the gate identificator
     */
    public function getFreeEnclos()
    {
        
        $s = new \SearchDoc($this->dbaccess, Family\Zoo_enclos::familyName);
        $idespece = $this->getRawValue(MyAttributes::an_espece);
        $s->addFilter("%s ~ E'\\\\y%d\\\\y'", Attributes\Zoo_enclos::en_espece, $idespece);
        $s->addFilter("%s < %s", Attributes\Zoo_enclos::en_nbre,Attributes\Zoo_enclos::en_capacite );
        $s->overrideViewControl(); // no test view acl
        $s->setObjectReturn();
        $s->search();
        
        $nbdoc = $s->count();
        
        if ($nbdoc == 0) $err = _("zoo:no enclos");
        else {
            while ($enclos = $s->getNextDoc()) {
                return $enclos->getPropertyValue('initid'); // first found
                
            }
        }
        return 0;
    }
    
    public function verifyCapacity()
    {
        
        $err = "";
        $s = new \SearchDoc($this->dbaccess, Family\Zoo_enclos::familyName);
        $s->addFilter("%s ~ E'\\\\y%d\\\\y'", Attributes\Zoo_enclos::en_espece,$this->getRawValue(MyAttributes::an_espece));
        $s->overrideViewControl(); // no test view acl
        $s->setObjectReturn();
        $s->search();
        $nbdoc = $s->count();
        addLogMsg($s->getSearchInfo());
        if ($nbdoc == 0) $err = _("zoo:no enclos for this species");
        else {
            /**
             * @var \Zoo\Enclos $enclos
             */
            while ($enclos = $s->getNextDoc()) {
                $err = $enclos->detectMaxCapacity();
                if ($err == "") {
                    break; // first found
                    
                }
            }
            if ($err != "") $err = sprintf(_("zoo:each enclos are full : %s") , $err);
        }
        return $err;
    }
    /**
     * refresh all childs to recompute father and mother
     */
    public function refreshChilds()
    {
        $err = "";
        $idchild = $this->getMultipleRawValues(MyAttributes::an_enfant);
        $oldidchild = $this->rawValueToArray($this->getOldRawValue(MyAttributes::an_enfant));
        // union unique of old and new values
        $childs = array();
        foreach ($idchild as $child) if ($child) $childs[$child] = $child;
        foreach ($oldidchild as $child) if ($child) $childs[$child] = $child;
        
        if (count($childs) > 0) {
            $it = new \DocumentList();
            $it->addDocumentIdentifiers($childs);
            /**
             * @var \Doc $doc
             */
            foreach ($it as $doc) {
                $doc->refresh();
            }
        }
        
        return $err;
    }
    /**
     * return id of its health card
     */
    function getHealthCardId()
    {
        
        $s = new \SearchDoc($this->dbaccess, Family\Zoo_carnetsante::familyName);
        $s->addFilter("%s = '%s'", Attributes\Zoo_carnetsante::ca_idnom, $this->initid);
        $s->overrideViewControl(); // no test view acl
        $s->slice = 3;
        $tdoc = $s->search();
        
        if (count($tdoc) == 1) return $tdoc[0]["id"];
        return 0;
    }
    /**
     * create its health card
     */
    function createHealthCard()
    {
        $err = '';
        $hc = createDoc($this->dbaccess, Family\Zoo_carnetsante::familyName);
        if ($hc) {
            $hc->setValue(Attributes\Zoo_carnetsante::ca_idnom, $this->initid);
            $err = $hc->Add();
            $hc->refresh();
        }
        
        return $err;
    }
    /**
     * view to notify veterinary
     * @templateController view to email notify veterinary
     */
    public function de_mail_sick($target = "_self", $ulink = true, $abstract = false)
    {
        $this->viewdefaultcard($target, $ulink, $abstract);
        $idcarnet = $this->getHealthCardId();
        $this->lay->set("idcarnet", $idcarnet);
    }


}
?>