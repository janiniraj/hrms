<?php
/**
 * Created by PhpStorm.
 * User: hrms
 * Date: 8/19/17
 * Time: 12:54 PM
 */

namespace Jobs\Admin\Api;

use Classes\AbstractModuleManager;

class JobsAdminManager extends AbstractModuleManager
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

        $this->addModelClass('JobTitle');
        $this->addModelClass('PayGrade');
    }
}
