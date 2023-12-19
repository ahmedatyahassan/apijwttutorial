<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index(){
        $categories = Category::get();
        return $this->listResponse($categories);
    }

    public function create(Request $request){
        $input = $request->only('name');
        $rules = ['name' => 'required'];

        $validator = Validator::make($input, $rules);
        if($validator->fails()){
           return $this->validationErrorResponse($validator->messages());
        }
        
        $category = Category::create(['name' => $request->name]);
        return $this->createdResponse($category);
    }
}
