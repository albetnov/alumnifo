<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Support\Facades\Auth;


class RoleHelper
{
    private static $userDestination, $superAdminDestination;
    private $userLayoutName = "guest", $adminLayoutName = "livewire.layouts.main", $userLayoutData, $adminLayoutData, $viewData = [];

    public static function redirectByRoles($userDestination, $superAdminDestination)
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            return to_route($superAdminDestination);
        }

        return to_route($userDestination);
    }

    public static function showViewByRoles($userDestination, $superAdminDestination)
    {
        self::$userDestination = $userDestination;
        self::$superAdminDestination = $superAdminDestination;
        return new self;
    }

    public function userLayout($layoutName)
    {
        $this->userLayoutName = $layoutName;
        return $this;
    }

    public function adminLayout($layoutName)
    {
        $this->adminLayoutName = $layoutName;
        return $this;
    }

    public function userLayoutData($layoutData)
    {
        $this->userLayoutData = $layoutData;
        return $this;
    }

    public function adminLayoutData($layoutData)
    {
        $this->adminLayoutData = $layoutData;
        return $this;
    }

    public function viewData($viewData)
    {
        $this->viewData = $viewData;
        return $this;
    }

    public function render()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            if (!$this->adminLayoutData) {
                throw new \Exception('adminLayoutData() is required');
            }
            return view(self::$superAdminDestination, $this->viewData)->layout($this->adminLayoutName, $this->adminLayoutData);
        }

        if ($this->userLayoutData) {
            return view(self::$userDestination, $this->viewData)->layout($this->userLayoutName, $this->userLayoutData);
        } else {
            return view(self::$userDestination, $this->viewData)->layout($this->userLayoutName);
        }
    }
}
