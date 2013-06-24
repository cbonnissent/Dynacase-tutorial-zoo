<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package ZOO
*/
/**
 * Species comportment
 */

namespace Zoo;
class Espece extends \Dcp\Family\Document
{
    /**
     * special edit view
     * @return void
     */
    function editcontinent()
    {
        $this->editAttr();
    }
}
?>