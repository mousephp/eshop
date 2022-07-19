<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\{ District, Province, Ward };
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $district;
    protected $ward;

    public function __construct(District $district, Ward $ward)
    {
        $this->district = $district;
        $this->ward     = $ward;
    }

    public function fetchDistrict(Request $request)
    {
        $data['districts'] = $this->district->where("province_id", $request->province_id)->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchWard(Request $request)
    {
        $data['wards'] = $this->ward->where("district_id", $request->district_id)->get(["name", "id"]);
        
        return response()->json($data);
    }
    
}
