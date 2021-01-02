<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Home;
use App\About;
use App\Contact;
use App\Article;
use App\Dog;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $locale=session('locale');
            $like=$locale."%";
            $home = Home::first();
            $contact = Contact::first();
            $articles = Article::latest()->where('article_code', 'like', $like)->paginate(4);
            $dogs1 = Dog::inRandomOrder()->whereNotNull('dog_image')->paginate(6);

            return view('home',compact('home','contact','articles','dogs1'));

    }

    public function view_about_us()
    {
        $locale = App::getLocale();

        if (App::isLocale('en')) {
            $about = About::find(2);
            $about_pic = About::first();

            return view('about_us',compact('about','about_pic'));
        }
        else {
            $about = About::first();
            $about_pic = About::first();

            return view('about_us',compact('about','about_pic'));
        }

    }

    public function view_contact_us()
    {
        $contact = Contact::first();
        return view('contact_us',compact('contact'));
    }

    public function view_articles()
    {
      if(session('locale')==""){
        $locale="th";
      }else{
        $locale=session('locale');
      }

      $like=$locale."%";
        $articles = Article::latest()->where('article_code', 'like', $like)->paginate(12);
        return view('articles', compact('articles'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
