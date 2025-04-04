<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\PrimaryColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CompanyController extends Controller
{
    public function index(){
        $company = CompanyProfile::all();
        return view('backend.modules.company.company_profile', compact('company'));
    }
    public function primaryColor(Request $request){
        $new_color = $request->primary_color;
        $color_data = json_decode(Cookie::get('color_data', '[]'), true);
        array_unshift($color_data, $new_color);
        $color_data = array_slice($color_data, 0, 5);
        Cookie::queue('color_data', json_encode($color_data), 60 * 24 * 365);
        $update = CompanyProfile::where('id', 1)->update([
            'primary_color' => $new_color,
            'primary_color_history' => json_encode($color_data)
        ]);

        if ($update == 1) {
            $response = response()->json(['success' => 'Primary Color Updated Successfully'], 200);
        } else {
            $response = response()->json(['error_success' => 'Primary Color not updated']);
        }

        return $response;
    }
    public function nameColor(Request $request){
        $new_name_color = $request->name_color;
        $name_color_data = json_decode(Cookie::get('name_color_data', '[]'), true);
        array_unshift($name_color_data, $new_name_color);
        $name_color_data = array_slice($name_color_data, 0, 5);
        Cookie::queue('name_color_data', json_encode($name_color_data), 60 * 24 * 365); 
        $update = CompanyProfile::where('id', 1)->update([
            'company_name_color' => $new_name_color,
            'company_name_color_history' => json_encode($name_color_data)
        ]);

        if ($update) {
            $response = response()->json(['success' => 'Name Color Updated Successfully'], 200);
        } else {
            $response = response()->json(['error_success' => 'Name Color not updated']);
        }

        return $response;
    }

    public function uploadlogo(Request $request){
        $images = $request->logo;
        if ($images == 'undefined') {
            $myimage = CompanyProfile::where('id', 1)->get(['company_logo']);
            $imageName = $myimage[0]->company_logo;
        } else {
            $image = $request->logo;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/company_logo'), $imageName);
        }
        $update = CompanyProfile::where('id', 1)->update([
            'company_logo' => $imageName
        ]);
        if ($update == 1) {
            $response = response()->json(['success' => 'Company Logo Uploaded Successfully'], 200);
        } else {
            $response = response()->json(['error_success' => 'Logo not Uploaded']);
        }
        return $response;
    }
    public function nameUpdate(Request $request){

        $update = CompanyProfile::where('id', 1)->update([
            'company_name' => $request->name,
            'company_name_status' => $request->name_status,
            'company_address' => $request->company_address,
            'address_status' => $request->address_status,
            'company_email' => $request->company_email,
            'email_status' => $request->email_status,
            'company_mobile' => $request->company_mobile,
            'mobile_status' => $request->mobile_status
        ]);
        if ($update == 1) {
            $response = response()->json(['success' => 'Company Details Updated Successfully'], 200);
        } else {
            $response = response()->json(['error_success' => 'Details not updated']);
        }
        return $response;
    }
}
