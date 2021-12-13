<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Admin;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home()
    {
        return view("admin/home");
    }

    public function settings()
    {
        return view('admin/settings');
    }

    public function allAds()
    {
        $all_ads = Ad::select('id', 'name', 'user_id', 'category', 'price', 'description', 'created_at', 'updated_at')
            ->with("users")->get()->toArray();
//dd($all_ads);
        return view('admin/ads', compact('all_ads'));
    }

    public function users()
    {
        return view('admin/users');
    }

    public function allUsers(Request $request)
    {
        $users = User::select('id', 'name', "surname", "city", "email", "personal_number", "mobile_number")->get()->toArray();

        return response()->json(['data' => $users]);
    }

    public function deleteUser()
    {
        $user_id = request()->user_id;
        $delete = User::destroy($user_id);
        if ($delete) {
            return response()->json(["status" => "success"]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }

    public function getAdInfo(Request $request)
    {
        if (request()->ajax()) {
            abort(401);
        }
        $ads_edit = Ad::select('id', 'name', 'user_id', 'category', 'price', 'description')
            ->where(['id' => $request->ad_id])->get()->toArray();

        return response()->json(["ads" => $ads_edit]);
    }

    public function editAds(Request $request)
    {
        $request->validate([
            'ad_name_edit' => ['required', 'string', 'max:255'],
            'ad_price_edit' => 'required',
            'ad_category_edit' => 'required',
            'ad_description_edit' => 'required'
        ]);

        $ad_id = $request->ad_id;
        $ad_name_edit = $request->ad_name_edit;
        $ad_price_edit = $request->ad_price_edit;
        $ad_category_edit = $request->ad_category_edit;
        $ad_description_edit = $request->ad_description_edit;

        $ad = Ad::find($ad_id);
        $ad_update = $ad->update(["name" => $ad_name_edit, "price" => $ad_price_edit, "category" => $ad_category_edit, "description" => $ad_description_edit]);

        if ($ad_update) {
            return response()->json(["success" => true, "message" => "Successfully updated."]);
        } else {
            return response()->json(["success" => false, "message" => "All fields are required for update ad."]);
        }
    }

    public function deleteAds(Request  $request)
    {
        $id = request()->id;
        $delete = Ad::destroy($id);
        if ($delete) {
            return response()->json(["success" => true, "message" => "Successfully deleted ad."]);
        } else {
            return response()->json(["success" => false, "message" => "Error."]);
        }
    }

    public function editAdminProfile(Request $request)
    {
        if (!request()->ajax())
            abort(401);
        $user_exist = Admin::where("email", request()->email)->first();
        if (!is_null($user_exist) && $user_exist['email'] != auth()->user()->email) {
            return response()->json(["error" => ["message" => " The email already exist, please enter a different email"]]);
        } else {
            $admin_updated = Admin::find(auth()->user()->id)->update(["email" => request()->email, "name" => request()->name, "surname" => request()->surname,]);
            if ($admin_updated) {
                return response()->json(["success" => ["message" => "Your account details are successfully updates"]]);
            } else {
                return response()->json(["status" => "error"]);
            }
        }
    }


}
