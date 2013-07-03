<?php

/**
 * Add child to an Animal
 *
 * @author Anakeen 2008
 * @version $Id: zoo_addchild.php,v 1.6 2011-03-21 11:14:44 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 * 
 *
 * @global string $docid Http var : document identificator
 * @global string $n Http var : number of new childs
 /**
 */


include_once("FDL/Class.Doc.php");

$usage="usage  --docid=<doc identificator> --n=<number of child>";
/**
 * @var Action $action
 */
$dbaccess=$action->GetParam("FREEDOM_DB");
if ($dbaccess == "") {
  print "Freedom Database not found : param FREEDOM_DB";
  exit;
}
$usage=new ApiUsage();
$usage->setText("create somes childs");
$docid=$usage->addRequiredParameter("docid","animal parent document identifier");
$n=intval($usage->addRequiredParameter("n","count of child needed")); // number of childs
$usage->verify();

if ($n<0) $action->exitError(sprintf("n must be greater than 0 :%s", $usage->getUsage()));

$doc=new_doc($dbaccess,$docid);
if ($doc->isAlive()) {
  $animalid=getFamIdFromName($dbaccess,'ZOO_ANIMAL');
  if ($doc->fromid != $animalid) {
    $fdoc=$doc->getFamilyDocument();
    $action->exitError(sprintf("%s [%d] document is not an animal (it is a %s)",
			       $doc->getTitle(),$doc->id,$fdoc->getTitle()));
  }
  
  $childs=$doc->getMultipleRawValues("an_enfant");
  $nc=count($childs);
$err='';
  for ($i=0;$i<$n;$i++) {
    $anchild=createDoc($dbaccess,"ZOO_ANIMAL");
    if (! $anchild) $action->exitError("cannot create ANIMAL");
    $anchild->setValue("an_nom",sprintf("%s Junior %d",
					$doc->getRawValue("an_nom"),($nc+$i+1)));
    $err=$anchild->setValue("an_espece",$doc->getRawValue("an_espece"));
    $err.=$anchild->setValue("an_naissance",$doc->getDate());
    $err.=$anchild->setValue("an_entree",$doc->getDate());    
    if (! $err) $err=$anchild->store();
    if ($err != "") $action->exitError($err);
    printf("%s [%d] created\n",$anchild->getTitle(),$anchild->id);
    $childs[]=$anchild->getPropertyValue('initid');
  }

  if ($err != "") $action->exitError($err);
  $err=$doc->setValue("an_enfant",$childs);
  $err=$doc->modify();
  if ($err != "") $action->exitError($err);
  print sprintf("Document <%s [%d]> has new childs\n",$doc->title,$doc->id);
 } else {
  print sprintf("Document <%s> is not alive\n",$docid);
 }


?>