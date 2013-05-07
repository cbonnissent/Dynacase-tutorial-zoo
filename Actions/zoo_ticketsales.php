<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
 */
/**
 * Display sum of sales
 *
 * @author Anakeen 2008
 * @version $Id: zoo_ticketsales.php,v 1.7 2011-02-01 16:40:08 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 *
 *
 */

include_once ("FDL/Class.Doc.php");
include_once ("FDL/Class.SearchDoc.php");
/**
 * Display sum of sales
 * @global string $date Http var : date of the report
 */
function zoo_ticketsales(Action & $action)
{
    $date = $action->getArgument("date");
    $dbaccess = $action->getParam("FREEDOM_DB");
    
    if (!$date) $date = Doc::getDate();
    
    $s = new SearchDoc($dbaccess, "ZOO_ENTREE");
    $s->addFilter("ent_date='%s'", $date);
    $s->setObjectReturn();
    $s->search();
    
    $pas = 0;
    $pes = 0;
    $na = 0;
    $ne = 0;
    $t = array();
    while ($ticket = $s->getNextDoc()) {
        $prixenfant = floatval($ticket->getFamilyParameterValue("ent_prixenfant"));
        $prixadulte = floatval($ticket->getFamilyParameterValue("ent_prixadulte"));
        $pe = intval($ticket->getRawValue("ent_enfant")) * $prixenfant;
        $pa = intval($ticket->getRawValue("ent_adulte")) * $prixadulte;
        $ne+= intval($ticket->getRawValue("ent_enfant"));
        $na+= intval($ticket->getRawValue("ent_adulte"));
        $pes+= $pe;
        $pas+= $pa;
        $t[] = array(
            "nbadulte" => $ticket->getRawValue("ent_adulte") ,
            "nbenfant" => $ticket->getRawValue("ent_enfant") ,
            "prixenfant" => $pe,
            "prixadulte" => $pa,
            "prixtotal" => $pe + $pa
        );
    }
    
    $action->lay->setBlockData("TICKETS", $t);
    $action->lay->set("nbadultes", $na);
    $action->lay->set("nbenfants", $ne);
    $action->lay->set("prixenfants", $pes);
    $action->lay->set("prixadultes", $pas);
    $action->lay->set("total", $pas + $pes);
    $action->lay->set("date", $date);
}

function zoo_xmlticketsales(Action & $action)
{
    header('Content-type: text/xml; charset=utf-8');
    zoo_ticketsales($action);
}
?>