<?php

namespace ZOO;
use \Dcp\AttributeIdentifiers\Zoo_contact as MyAttributes;

Class Zoo_contact extends \Dcp\Family\Document implements \IMailRecipient
{
    /**
     * return a RFC822-compliant mail address like "john" <john@example.net>
     * @return string
     */
    public function getMail()
    {
        return sprintf('"%s" <%s>', str_replace('"', '', $this->getTitle()) , $this->getRawValue(MyAttributes::zct_mail));
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
        return MyAttributes::zct_mail;
    }


}
?>