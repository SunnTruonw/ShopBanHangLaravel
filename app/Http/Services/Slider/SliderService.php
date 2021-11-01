<?php

namespace App\Http\Services\Slider;


use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService{
    
    public function store($request)
    {
        try {
            $data = $request->all();
            $slider = Slider::create($data);

            $request->session()->flash('success', 'Tạo Slider Thành Công'); 
        } catch (\Throwable $err) {
            //throw $th;
            $request->session()->flash('error', 'Tạo Slider Lỗi'); 
            \Log::info($err -> getMessage());

            return false;
        }
        

        return true;
    }

    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request,$slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
            $request->session()->flash('success', 'Cập Nhật Slider Thành Công');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'Cập Nhật Slider Lỗi');
            \Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            //$path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete('public/storage/uploads/2021/10/02/anh1.jpg');    //shoplaravel01/public/storage/uploads/2021/10/02/anh2.jpg
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return Slider::where('active' ,'1')->orderByDesc('sort_by')->get();
    }

   
}