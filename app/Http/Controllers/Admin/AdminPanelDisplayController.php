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
        return view('adminPanel', array('users' => $accountsNo));

    }

    /*
    *  Fetches the total number of user accounts from the database
    *
    *  @return int users
    */
    public function getTotalUsers() {

        return User::count('id');

    }

}