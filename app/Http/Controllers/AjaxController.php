<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class AjaxController extends Controller
{
    // Ajax ID from table Province
    public function getRegency($id)
    {
        if($id){
            return Regency::where('province_id', $id)->pluck('id', 'name')->all();        
        }
    }
    // Ajax ID from table Regency
    public function getDistrict($id)
    {
        if($id){
            return District::where('regency_id', $id)->pluck('id', 'name')->all();        
        }
    }
    // Ajax ID from table District
    public function getVillage($id)
    {
        if($id){
            return Village::where('district_id', $id)->pluck('id', 'name')->all();            
        }
    }
}
