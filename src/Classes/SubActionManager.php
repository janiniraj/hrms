<?php
/*
This file is part of HRMS Framework.

HRMS Framework is free software: you can redistribute it and/or modify




HRMS Framework is distributed in the hope that it will be useful,




You should have received a copy of the GNU General Public License
along with HRMS Framework. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------


Developer:  (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */
namespace Classes;

abstract class SubActionManager
{
    public $user = null;
    /* @var \Classes\BaseService $baseService*/
    protected $baseService = null;
    public $emailTemplates = null;
    protected $emailSender = null;

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setBaseService(BaseService $baseService)
    {
        $this->baseService = $baseService;
    }

    public function getCurrentProfileId()
    {
        return $this->baseService->getCurrentProfileId();
    }

    public function setEmailTemplates($emailTemplates)
    {

        $this->emailTemplates   = $emailTemplates;
    }

    public function getEmailTemplate($name)
    {
        //Read module email templates
        if ($this->emailTemplates == null) {
            $this->emailTemplates = array();
            if (is_dir(MODULE_PATH.'/emailTemplates/')) {
                $ams = scandir(MODULE_PATH.'/emailTemplates/');
                foreach ($ams as $am) {
                    if (!is_dir(MODULE_PATH.'/emailTemplates/'.$am) && $am != '.' && $am != '..') {
                        $this->emailTemplates[$am] = file_get_contents(MODULE_PATH.'/emailTemplates/'.$am);
                    }
                }
            }
        }

        return  $this->emailTemplates[$name];
    }

    public function setEmailSender($emailSender)
    {
        $this->emailSender = $emailSender;
    }

    public function getUserFromProfileId($profileId)
    {
        return $this->baseService->getUserFromProfileId($profileId);
    }
}
