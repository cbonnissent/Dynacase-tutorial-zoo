<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package ZOO
*/
/**
 * Ticket comportment
 *
 */
namespace Zoo;
use \Dcp\AttributeIdentifiers as Da;
use \Dcp\AttributeIdentifiers\Zoo_entree as Aself;
use \Dcp\Family as Df;
class Entree extends Df\Document
{
    
    public function postStore()
    {
        $err = parent::postStore();
        if ($err == "") $err = $this->setValue(Aself::ent_prix, $this->getCost());
        return $err;
    }
    /**
     * return cost
     * @return float
     */
    public function getCost()
    {
        $nb_adulte = intval($this->getRawValue(Aself::ent_adulte));
        $nb_enfant = intval($this->getRawValue(Aself::ent_enfant));
        $prix_adulte = floatval($this->getFamilyParameterValue(Aself::ent_prixadulte));
        $prix_enfant = floatval($this->getFamilyParameterValue(Aself::ent_prixenfant));
        
        $resultat = ($nb_adulte * $prix_adulte) + ($nb_enfant * $prix_enfant);
        
        return $resultat;
    }
    /**
     * view tickets one by personn
     * @templateController view tickets one by personn
     */
    public function viewtickets($target = "_self", $ulink = true, $abstract = false)
    {
        
        $nb_adulte = intval($this->getRawValue(Aself::ent_adulte));
        $nb_enfant = intval($this->getRawValue(Aself::ent_enfant));
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
        
        $this->lay->set("today", $this->getRawValue(Aself::ent_date, $this->getDate()));
        
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
}
