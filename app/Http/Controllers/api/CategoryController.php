<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends ApiResponseController
{
    //todas las categorias
    public function all(){
        return $this->succesResponse(Category::all());
    }
//categorias paginadas
    public function index(){
        return $this->succesResponse(Category::paginate(10));
    }
}
