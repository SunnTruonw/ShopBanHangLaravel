<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuServices ;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;


class MenuController extends Controller
{ 
    protected $menuServices;

    public function __construct(MenuServices $menuServices){
        $this->menuServices =$menuServices;
    }

    public function create(){
        return view('admin.menu.add', [
            'title' => 'Thêm Sản Phẩm Mới ',
            'menus' => $this->menuServices->getParent()
        ]);
    }
    
    public function store(CreateFormRequest $request){
        //dd($request->input());
        $result  = $this->menuServices->create($request);

        return redirect() ->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title' => 'Danh Sách Danh Mục Mới Nhất',
            'menus' => $this->menuServices->getAll()
        ]);
    }

    public function show(Menu $menu){
        //dd($menu->name);
        return view('admin.menu.edit',[
            'title' => 'Chỉnh sửa Danh Mục Sản Phẩm : ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuServices->getParent()
        ]);
    }

    public function update(Menu $menu ,CreateFormRequest $request){
        $this->menuServices->update($request , $menu);

        return redirect('/admin/menu/list');
    }

    public function destroy(Request $request)
    {
       $result = $this->menuServices->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
