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
            'passing_year' => 'required',
            'member_phone' => 'required',
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
            'phone' => $request->member_phone,
            'total_fee' => $total_fee,
            'payment_status' => 0,
            'member_id' => $request->member_name
        ]);

        $guest = array();

        for($i = 0; $i < $request->guest_number; $i++){
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

        notify()->success('You have registered successfully, please pay now!!');
        return view('frontend_theme.corporate.shurjopayment',compact('register'));
    }
}
