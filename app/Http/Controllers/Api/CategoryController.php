<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\Article;
use DB;

class CategoryController extends Controller {

    public function index(){
        return CategoryResource::collection(Category::orderBy('id','DESC')->paginate(10));
    }


    public function store(Request $request){
        $validators=Validator::make($request->all(),[
            'title'=>'required|unique:categories',
            'slug'=>'required|unique:categories'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $category=new Category();
            $category->title=$request->title;
            $category->slug=strtolower(implode('-',explode(' ',$request->slug)));
            $category->save();
            return Response::json(['success'=>'Category created successfully !']);
        }
    }


    public function show($categoryid){
        $id = $categoryid;
        $news = DB::table('articles')->where('category_id',"=", $id)->get();
        if(count($news)==0){
            return Response::json(['message'=>'By this category articles not found!']);
        }else{
            return Response::json($news);
        }

    }


    public function searchCategory(Request $request){
        $categories=Article::where('category','LIKE','%'.$request->keyword.'%')->get();
        if(count($categories)==0){
            return Response::json(['message'=>'No category match found !']);
        }else{
            return Response::json($categories);
        }
    }
}
