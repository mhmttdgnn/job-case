<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\RepairType;
use App\Models\RepairAddress;
use App\Models\Repair;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $brands = Brand::all();
        $types = RepairType::all();
        return view('welcome', compact('brands', 'types'));
    }

    public function loadModels(Request $request)
    {
        $models = CarModel::where('brand_id', $request->id)->get();

        $select = '<select id="car_models" name="models" class="form-control">';
        $select .= '<option value="">Seçiniz</option>';
        foreach ($models as $item) {
            $select .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        $select .= '</select>';
        return $select;
    }
    
    public function loadAddresses(Request $request)
    {
        $addresses = RepairAddress::where('repair_type_id', $request->id)->get();

        $select = '<select id="repair_address" name="addresses" class="form-control">';
        $select .= '<option value="">Seçiniz</option>';
        foreach ($addresses as $item) {
            $select .= '<option value="'.$item->id.'">'.$item->address.'</option>';
        }
        $select .= '</select>';
        return $select;
    }

    public function checkDate(Request $request)
    {
        $checkRepair = Repair::where('repair_date', $request->date)
            ->where('repair_place', $request->address)
            ->exists();

        if ($checkRepair == true) {
            return response()->json(['success' => false, 'message' => 'Bu tarihe bağlı olarak adresimizde tamir kontenjanı dolmuştur!']);
        } else {
            return response()->json(['success' => true]);
        }
    }

    public function repairCreate(Request $request)
    {
        $hasUser = User::where('name', $request->name)->exists();
        if ($hasUser == true) {
            return response()->json(['success' => false, 'message' => 'Müşteri kaydı oluşturulurken bir hata oluştu!']);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = Str::random(15).'@musteri.com';
            $user->password = "asd123asd";
            $user->save();

            $repair = new Repair();
            $repair->user_id = $user->id;
            $repair->car_id = $request->models;
            $repair->repair_place = $request->addresses;
            $repair->repair_date = $request->date;
            $repair->repair_time = $request->hour.':'.$request->minute;
            $repair->save();

            return response()->json(['success' => true, 'message' => 'Müşteri ve tamir kaydı başarıyla oluşturulmuştur!']);
        }
    }
}
