<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\registration\MemberRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = MemberRegistration::with('guests')->orderBy('id', 'DESC')->paginate(10);

        return view('backend.admin.registration.index',compact('registrations'));
    }

    public function invitations($id)
    {
        $member = DB::table('member_registrations')->where("id",$id)->first();
        return view('backend.admin.registration.invitation_card',compact('member'));
    }
}
