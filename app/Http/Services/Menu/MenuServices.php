<?php

 namespace App\Http\Services\Menu;


use App\Models\Menu;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Session;



class MenuServices{

    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }

    public function show()
    {
        return Menu::select('name' , 'id' , 'thumb')
        ->where('parent_id' , '0')
        ->orderByDesc('id')
        ->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request){
        try {
            Menu::create([
                'name' =>(string) $request->input('name'),
                'parent_id' =>(int) $request->input('parent_id'),
                'description' =>(string) $request->input('description'),
                'thumb' =>(string) $request->input('thumb'),
                'content' =>(string) $request->input('content'),
                'active' =>(int) $request->input('active'),
                //'slug' =>Str::slug($request->input('name'))

            ]);
            $request->session()->flash('success','Tạo danh mục thành công' );

        } catch (\Throwable $err) {
            //throw $th;
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update( $request, $menu) :bool
    {
        if($request->input('parent_id') != $menu->id){
             $menu->parent_id = (int) $request->input('parent_id');
        }


        $menu->name = (string) $request->input('name');

        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->thumb = (string) $request->input('thumb');
        $menu->active = (int) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }
    public function destroy($request){

        $id = $request->input('id');
        $menu = Menu::where('id', $id)->first();

        if ($menu) {
            $menu->delete();
            return true;
        }

        return false;
    }

    public function getId($id)
    {
        return Menu::where('id' , $id)
            ->Where('active' , 1)
            ->firstOrFail();
    }

    public function getProduct($menu , $request)
    {
        $query = $menu->products()->select('id', 'name' ,'price' , 'price_sale' , 'thumb')
        ->where('active' , 1);


        if($request->input('price')){
            $query ->orderBy('price' , $request->input('price'));
        }


     return $query->orderByDesc('id')
        ->paginate(12)
        ->withQueryString();
    }
 }
