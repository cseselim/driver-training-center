<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountInfoRequest;
use Backpack\CRUD\app\Http\Controllers\MyAccountController as BackpackMyAccountController;

class MyAccountController extends BackpackMyAccountController
{
    /**
     * Save the editable account information to the database.
     *
     * @param \App\Http\Requests\AccountInfoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAccountInfoForm($request)
    {
        return parent::postAccountInfoForm($request);
    }
}
