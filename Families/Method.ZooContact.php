<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package FDL
*/
/**
 * Animal comportment
 *
 * @author Anakeen 2010
 * @version $Id: Method.Animal.php,v 1.9 2011-02-01 16:40:08 eric Exp $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package freedom-zoo
 */
/**
 */
/**
 * @begin-method-ignore
 * this part will be deleted when construct document class until end-method-ignore
 */
Class _ZOO_CONTACT extends Doc implements IMailRecipient
{
    /**
     * @end-method-ignore
     */
    /**
     * return a RFC822-compliant mail address like "john" <john@example.net>
     * @return string
     */
    public function getMail()
    {
        return sprintf('"%s" <%s>', str_replace('"', '', $this->getTitle()) , $this->getRawValue("zct_mail"));
    }
    /**
     * return a mail address in a user-friendly representation, which
     * might not be RFC822-compliant.
     * (e.g. "John Doe (john.doe (at) EXAMPLE.NET)")
     * @return string
     */
    public function getMailTitle()
    {
        return $this->getMail();
    }
    /**
     * return attribute used to filter from keyword
     * @return string
     */
    public static function getMailAttribute()
    {
        return "zct_mail";
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


