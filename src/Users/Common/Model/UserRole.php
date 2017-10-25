<?php
/*















------------------------------------------------------------------


Developer:  (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

namespace Users\Common\Model;

use Model\BaseModel;

class UserRole extends BaseModel
{
    public function getAdminAccess()
    {
        return array('get','element','save','delete');
    }

    public function getUserAccess()
    {
        return array();
    }

    public $table = 'UserRoles';
}
