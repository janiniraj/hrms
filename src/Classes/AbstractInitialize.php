<?php
/*
This file is part of HRMS Framework.

HRMS Framework is free software: you can redistribute it and/or modify




HRMS Framework is distributed in the hope that it will be useful,





along with HRMS Framework. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------



 */
namespace Classes;

abstract class AbstractInitialize
{
    /* @var \Classes\BaseService $baseService */
    public $baseService = null;
    public function setBaseService($baseService)
    {
        $this->baseService = $baseService;
    }

    public function getCurrentProfileId()
    {
        return $this->baseService->getCurrentProfileId();
    }

    abstract public function init();
}
