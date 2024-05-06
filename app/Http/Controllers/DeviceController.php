<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        return Device::all();
    }

    public function store(Request $request)
    {
        $device = new Device;
        $device->name = $request->name;
        $device->min_value = $request->min_value;
        $device->max_value = $request->max_value;
        $device->current_value = $request->current_value;
        $device->save();
        return response()->json([
            "message" => "Device telah ditambahkan."
        ], 201);

    }

    public function show($id)
    {
        return Device::find($id);
    }

    public function update(Request $request, string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->name = is_null($request->nama_device) ? $device->name : $request->name;
            $device->min_value = is_null($request->nilai_min) ? $device->min_value : $request->min_value;
            $device->max_value = is_null($request->nilai_max) ? $device->max_value : $request->max_value;
            $device->current_value = is_null($request->nilai) ? $device->current_value : $request->current_value;
            $device->save();
            return response()->json([
                "message" => "Device telah diupdate."
            ], 201);
        } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }

    }

    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return response()->json([
                "message" => "Device telah dihapus."
            ], 201);
        } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }

    }

    public function web_index(){
        return view('devices', [
            "title" => "devices",
            "devices" => Device::all() 
        ]);
    }

    public function web_show($id){
        return view('device', [
            "title" => "device",
            "device" => Device::find($id)
        ]);
    }
}
