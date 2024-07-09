<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        if (view()->exists("pages.{$page}")) {
          
                switch ($page) {
                    
                    case 'questAnswer':
                        $data['title'] = 'Your Quest Answer Page Title';
                        return view("pages.{$page}", $data);
    
            return view("pages.{$page}");
        }
        return abort(404);
    }
    
}
}