<?php
/**
 * Created by PhpStorm.
 * User: hrms
 * Date: 8/19/17
 * Time: 4:28 PM
 */

namespace Permissions\Admin\Api;

use Classes\AbstractModuleManager;

class PermissionsAdminManager extends AbstractModuleManager
{

    public function initializeUserClasses()
    {
    }

    public function initializeFieldMappings()
    {
    }

    public function initializeDatabaseErrorMappings()
    {
    }

    public function setupModuleClassDefinitions()
    {
        $this->addModelClass('Permission');
    }
}
