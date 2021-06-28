<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CommentResource;
use Illuminate\Validation\Rule;
use App\Models\Article;
use App\Models\Comment;
use Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller {

    public function index(){
        return ArticleResource::collection(Article::orderBy('id','DESC')->paginate(10));
    }


    public function store(Request $request){
        $validators=Validator::make($request->all(),[
            'title'=>'required',
            'anons'=> 'required',
            'body'=>'required',
            'category'=>'required',
            'category_id'=>'required',
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $article=new Article();
            $article->title=$request->title;
            $article->anons=$request->anons;
            $article->body=$request->body;
            $article->author_id=Auth::user()->id;
            $article->category=$request->category;
            $article->category_id=$request->category_id;
            $article->save();
            return Response::json(['success'=>'Article created successfully !']);
        }
    }


    public function show($id){
        if(Article::where('id',$id)->first()){
            return new ArticleResource(Article::findOrFail($id));
        }else{
            return Response::json(['error'=>'Articles by this category not found!']);
        }
    }




    public function searchArticle(Request $request){
        $articles=Article::where('title','LIKE','%'.$request->keyword.'%')->get();
        if(count($articles)==0){
            return Response::json(['message'=>'No article match found !']);
        }else{
            return Response::json($articles);
        }
    }


}
