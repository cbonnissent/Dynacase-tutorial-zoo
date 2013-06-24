<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package ZOO
*/
/**
 * Contact Person
 *
 */
namespace Zoo;
use \Dcp\AttributeIdentifiers\Zoo_contact as Aself;
class Contact extends \Dcp\Family\Document implements \IMailRecipient
{

    /**
     * return a RFC822-compliant mail address like "john" <john@example.net>
     * @return string
     */
    public function getMail()
    {
        return sprintf('"%s" <%s>', str_replace('"', '', $this->getTitle()) , $this->getRawValue(Aself::zct_mail));
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
        return Aself::zct_mail;
    }
}


