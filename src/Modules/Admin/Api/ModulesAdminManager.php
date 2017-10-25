<?php
/*















------------------------------------------------------------------



 */
namespace Modules\Admin\Api;

use Classes\AbstractModuleManager;
use Classes\UIManager;

class ModulesAdminManager extends AbstractModuleManager
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
        $this->addModelClass('Module');
    }

    public function initQuickAccessMenu()
    {
        UIManager::getInstance()->addQuickAccessMenuItem(
            "Setup Modules",
            "fa-cogs",
            CLIENT_BASE_URL."?g=admin&n=modules&m=admin_System",
            array("Admin")
        );
    }
}
