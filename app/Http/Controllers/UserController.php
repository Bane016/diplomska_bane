<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function profile()
    {

        return view('user/profile');
    }

    public function settings()
    {
        $image = (!is_null(auth()->user()->img) && !empty(auth()->user()->img)) ? "user_images/" . auth()->user()->img : null;
        return view('user/settings', compact('image'));
    }

    public function addAds(Request $request)
    {
//        dd($request->all());
        $id = auth()->user()->id;

        $request->validate([
            'ad_name' => ['required', 'string', 'max:255'],
            'ad_price' => 'required',
            'ad_category' => 'required',
            'ad_description' => 'required',
        ]);

        $newAd = Ad::create(
            [
                'name' => $request->ad_name,
                'user_id' => $id,
                'price' => $request->ad_price,
                'category' => $request->ad_category,
                'description' => $request->ad_description,
            ]);

        if ($newAd) {
            return response()->json(["success" => true, "message" => $request->ad_name. ' was successfully added in your Ads']);
        } else {
            return response()->json(["success" => false, "message" => $request->name . 'Error']);
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

    public  function deleteAds(Request $request)
    {
        $id = request()->id;
        $delete = Ad::destroy($id);
        if ($delete) {
            return response()->json(["success" => true, "message" => "Successfully deleted ad."]);
        } else {
            return response()->json(["success" => false, "message" => "Error."]);
        }
    }

    public function editProfile(Request $request)
    {
        if (!request()->ajax())
            abort(401);
        $user_exist = User::where("email", request()->email)->first();
        if (!is_null($user_exist) && $user_exist['email'] != auth()->user()->email) {
            return response()->json(["error" => ["message" => " The email already exist, please enter a different email"]]);
        } else {
            $user = User::where("id", auth()->user()->id)->first();
            if (request()->hasFile('img')) {

                //get filename with extension
                $fileNameWithExt = $request->file('img')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just ext
                $extension = $request->file('img')->getClientOriginalExtension();
                //filenaem to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                //upload image path
                $path = $request->file('img')->storeAs('user_images', $fileNameToStore);//C:\xampp\htdocs\lsapp>php artisan storage:link , za da naprave path na slikite
                if (!empty($path)) {
                    $user->img = $fileNameToStore;
//                    User::where("id", auth()->user()->id)->update(['img' => $fileNameToStore]);
                }
            }
            $user_updated = User::find(auth()->user()->id)->update(["email" => request()->email, "name" => request()->name, "surname" => request()->surname,
                                                "personal_number" => request()->personal_number, "mobile_number" => request()->mobile_number, "city" => request()->city]);
            if ($user_updated) {
                return response()->json(["success" => ["message" => "Your account details are successfully updates"]]);
            } else {
                return response()->json(["status" => "error"]);
            }
        }

    }

}
