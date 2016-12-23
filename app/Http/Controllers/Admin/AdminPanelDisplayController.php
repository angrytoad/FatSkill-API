<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminPanelDisplayController extends controller {

    /*
    *  Gathers data and displays view
    */
    public function displayPanel() {

        $accountsNo = $this->getTotalUsers();
        $reg_accountsNo = $this->getRegularUsers();
        return view('adminPanel', array(
            'users' => $accountsNo,
            'reg_users' => $reg_accountsNo
        ));

    }

    /*
    *  Fetches the total number of user accounts from the database
    *
    *  @return int users
    */
    public function getTotalUsers() {

        return User::count('id');

    }

    public function getRegularUsers() {
        return User::where('admin', false)->count('id');
    }

}