<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MemberRegController extends Controller
{
    public function index()
    {
        $members = DB::table('members')->select('year_pass')->groupBy('year_pass')->get();

        return view('frontend_theme.corporate.members_registration',compact('members'));
    }

    public function getName($year)
    {
        $member_name = DB::table('members')->where('year_pass',$year)->get();
        return response()->json([
            'memberName' => $member_name,
        ]);
    }

    public function registration(Request $request)
    {
        $this->validate($request,[
            'member_name' => 'required',
            'member_photo' => 'required',
            'occupation' => 'required',
            'present_workplace' => 'required',
            'present_address' => 'required',
            'passing_year' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:member_registrations',
            'guest_name.*' => 'required',
            'guest_gender.*' => 'required',
            'guest_relation.*' => 'required'
        ]);

        $current_register = DB::table('member_registrations')->where("member_id",$request->member_name)->first();
        if ($current_register) {
            notify()->error('You have already registered successfully');
            return redirect()->back();
        }

        // //get form image
        $image = $request->file('member_photo');
        $slug = Str::slug($request->member_name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $memberphotoPath = public_path('uploads/postphoto');
            $img                     =       Image::make($image->path());
            $img->save($memberphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
        }

        $guest_fee = 1000*$request->guest_number;

        $total_fee = 2000 + $guest_fee;

        $member_name = DB::table('members')->where('id',$request->member_name)->first();

        $register = DB::table('member_registrations')->insertGetId([
            'name' => $member_name->name,
            'passing_year' => $request->passing_year,
            'photo' => $imagename,
            'phone' => $request->phone,
            'email' => $request->email,
            'occupation' => $request->occupation,
            'present_workplace' => $request->present_workplace,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'total_fee' => $total_fee,
            'payment_status' => 0,
            'member_id' => $request->member_name
        ]);

        $guest = array();

        for($i = 0; $i < $request->guest_number; $i++){
            if($request->guest_photo){
                $guest_image = $request->guest_photo[$i];
                $guest_slug = Str::slug($request->guest_name[$i]);
    
                if(isset($guest_image))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $guest_imagename = $guest_slug.'-'.$currentDate.'-'.uniqid().'.'.$guest_image->getClientOriginalExtension();
    
                    $guestphotoPath = public_path('uploads/postphoto');
                    $img                     =       Image::make($image->path());
                    $img->save($guestphotoPath.'/'.$guest_imagename);
    
                }
                else
                {
                    $guest_imagename = null;
                }
            }
            else
            {
                $guest_imagename = null;
            }

            $guest[] = array(
                'member_registration_id' => $register,
                'name' => $request->guest_name[$i],
                'age' => $request->guest_age[$i],
                'gender' => $request->guest_gender[$i],
                'relation' => $request->guest_relation[$i],
                'photo' => $guest_imagename,
               );
        }

        DB::table('guests')->insert($guest);

        $registered_member = DB::table('member_registrations')->where('id',$register)->first();

        notify()->success('You have registered successfully, please pay now!!');
        return view('frontend_theme.corporate.shurjopayment',compact('register','registered_member'));
    }

    public function search()
    {
        return view('frontend_theme.corporate.due_payment');
    }

    public function registrationSearch(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $registered_member = DB::table('member_registrations')->where('phone',$request->phone)->first();
        if(!$registered_member){
            notify()->error('Not registered with this number yet..!!');
            return redirect()->back();
        }
        $register = $registered_member->id;
        return view('frontend_theme.corporate.shurjopayment',compact('register','registered_member'));
    }
}
