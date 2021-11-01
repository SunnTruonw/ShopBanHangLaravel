<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuServices ;


class MenuController extends Controller
{
    protected $menuServices;

    public function __construct(MenuServices $menuServices){
        $this->menuServices =$menuServices;
    }

    public function index(Request $request , $id , $slug ='')
    {
        $menu = $this->menuServices->getId($id);

        $products = $this->menuServices->getProduct($menu, $request);

        //dd($products);
        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu'  => $menu
        ]);
    }

}
