<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use SEOMeta;

class PostController extends Controller
{
    public function index(){

        SEOTools::setTitle('Home');
        SEOTools::setDescription('This is my page description');
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::twitter()->setTitle('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('welcome',[
            'posts'=>Post::with('user:id,name')->select('user_id','title','slug','created_at')->paginate(10)
        ]);
    }

    public function view($slug)
    {
        $post = Post::whereSlug($slug)
            ->withCount(['likes'])
            ->with([
                'tags:id,name,css_class,slug',
                'user:id,profile',
                'comments:id,user_id,parent_id,comment,commentable_id,commentable_type,created_at',
                'comments.user:id,profile',
                'comments.replies:id,user_id,parent_id,comment,commentable_id,commentable_type,created_at',
                'comments' => function ($q) {
                    $q->withCount('likes');
                },
                'comments.replies' => function ($q) {
                    $q->withCount('likes');
                }
            ])
            ->first();
        SEOTools::setTitle($post->title);
        SEOTools::setDescription($post->resume);
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $post->category, 'property');
        SEOMeta::addKeyword(['key1', 'key2', 'key3']);

        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::opengraph()->setDescription($post->resume);
        SEOTools::opengraph()->setTitle($post->title);
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::twitter()->setTitle('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');


        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->addProperty('locale', 'pt-br');
        SEOTools::opengraph()->addProperty('locale:alternate', ['pt-pt', 'en-us']);

        SEOTools::opengraph()->addImage($post->banner_image);
           SEOTools::opengraph()->addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);
        SEOTools::opengraph()->addImage('http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);
        
        SEOTools::jsonLd()->setTitle($post->title);
        SEOTools::jsonLd()->setDescription($post->resume);
        SEOTools::jsonLd()->setType('Article');
        // SEOTools::->jsonLd()->addImage($post->images->list('url'));

        return view('detail',['post'=>$post]);
    }

    public function upload(Request $request){
        dd($request->toArray());
    }
}
