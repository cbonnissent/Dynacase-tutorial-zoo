<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
*/
/**
 * Ticket comportment
 *
 * @author Anakeen 2010
 * @version $Id: Method.Entree.php,v 1.4 2010-04-30 13:44:07 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 */
/**
 */
/**
 * @begin-method-ignore
 * this part will be deleted when construct document class until end-method-ignore
 */
Class _ZOO__ENTREE extends Doc
{
    /*
     * @end-method-ignore
    */
    
    public function postStore()
    {
        $err = parent::postStore();
        if ($err == "") $err = $this->setValue("ent_prix", $this->getCost());
        return $err;
    }
    /**
     * return cost
     * @return float
     */
    public function getCost()
    {
        $nb_adulte = intval($this->getRawValue("ent_adulte"));
        $nb_enfant = intval($this->getRawValue("ent_enfant"));
        $prix_adulte = floatval($this->getFamilyParameterValue("ent_prixadulte"));
        $prix_enfant = floatval($this->getFamilyParameterValue("ent_prixenfant"));
        
        $resultat = ($nb_adulte * $prix_adulte) + ($nb_enfant * $prix_enfant);
        
        return $resultat;
    }
    /**
     * view tickets one by personn
     * @templateController view tickets one by personn
     */
    function viewtickets($target = "_self", $ulink = true, $abstract = false)
    {
        
        $nb_adulte = intval($this->getRawValue("ent_adulte"));
        $nb_enfant = intval($this->getRawValue("ent_enfant"));
        $t = array();
        for ($i = 0; $i < $nb_adulte; $i++) {
            $t[] = array(
                "type" => _("Adult") ,
                "isAdult" => true
            );
        }
        for ($i = 0; $i < $nb_enfant; $i++) {
            $t[] = array(
                "type" => _("Child") ,
                "isAdult" => false
            );
        }
        
        $this->lay->set("today", $this->getRawValue("ent_date", $this->getDate()));
        
        $this->lay->set("n", $nb_adulte + $nb_enfant);
        $this->lay->setBlockData("TICKET", $t);
    }
    
    public static function positiveNumber($n)
    {
        if ($n < 0) {
            return sprintf(_("%s must not be negative") , $n);
        }
        return '';
    }
    public static function strictPositiveNumber($n)
    {
        if ($n <= 0) {
            return sprintf(_("%s must be positive") , $n);
        }
        return '';
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