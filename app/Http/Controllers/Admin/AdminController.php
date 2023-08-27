<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AssignAdminMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function assignAdmin($id){
       $user = User::where('id',$id)->first();
        if (isset($user)){
            if ($user->hasRole(['admin','owner'])){
                return $this->error(errors:trans('validation.custom.admin.already_admin'));
            }else{
                $adminRole = Role::where('name','admin')->first();
                $user->assignRole($adminRole);
                sendMail($user->email,new AssignAdminMail($user->first_name));
                return $this->success(trans('validation.custom.admin.assign_admin'));
            }
        }
        return $this->notFoundResponse(trans('validation.custom.user.not_found'));
    }
}
