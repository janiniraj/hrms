<?php
/**
 * Created by PhpStorm.
 * User: hrms
 * Date: 8/19/17
 * Time: 2:55 PM
 */

namespace Loans\Admin\Api;

use Classes\AbstractModuleManager;

class LoansAdminManager extends AbstractModuleManager
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

        $this->addModelClass('CompanyLoan');
    }
}
