<?php
/*















------------------------------------------------------------------



 */

namespace Modules\Common\Model;

use Model\BaseModel;

class Module extends BaseModel
{
    public function getAdminAccess()
    {
        return array("get","element","save","delete");
    }

    public function getUserAccess()
    {
        return array();
    }
    public $table = 'Modules';
}
