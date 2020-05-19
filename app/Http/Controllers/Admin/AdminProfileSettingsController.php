<?php

namespace App\Http\Controllers\Admin;

class AdminProfileSettingsController extends AdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->pageIcon = 'icon-user';
        $this->pageTitle = __('app.menu.profileSettings');
    }

    public function index(){
        $this->userDetail = $this->user;
        $this->employeeDetail = $this->user->employee_details;

        return view('admin.profile.index', $this->data);
    }

}
