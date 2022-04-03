<?php

namespace App\Http\Livewire\Modules;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    private static $userDestination;
    private static $superAdminDestination;
    private $userLayoutName = "guest";
    private $adminLayoutName = "livewire.layouts.main";
    private $userLayoutData;
    private $adminLayoutData;
    private $viewData = [];

    public static function alterByRole($data, $table)
    {
        $request = Request::create([
            'table_type' => $table,
            'user_id'    => Auth::user()->id,
            'status'     => 'pending',
        ]);

        if (Auth::user()->hasRole('user')) {
            $data['id_request'] = $request->id;
        }

        return $data;
    }

    public static function validate()
    {
        $user = Auth::user();
        if ($user->hasRole('user') && $user->hasPermissionTo('participate')) {
            $user->revokePermissionTo('participate');
        }
    }

    public static function redirectByRoles($userDestination, $superAdminDestination, $deactiveValiate = false)
    {
        if (!$deactiveValiate) {
            self::validate();
        }

        if (Auth::user()->hasRole('SuperAdmin')) {
            return to_route($superAdminDestination);
        }

        return to_route($userDestination);
    }

    public static function showViewByRoles($userDestination, $superAdminDestination)
    {
        self::$userDestination = $userDestination;
        self::$superAdminDestination = $superAdminDestination;

        return new self();
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
