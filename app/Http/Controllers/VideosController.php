<?php

namespace App\Http\Controllers;

use Request;

//use Illuminate\Http\Request;
use App\Http\Requests\CreateVideoRequest;
use App\Video;
use App\Category;
use Auth;
use Session;


class VideosController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth', ['only' => 'create']); //['only' => 'index']
    }
    /*
    * Pobieramy listę filmów z bazy
    */
    public function index()
    {
    	$videos = Video::latest()->get();
    	return view('videos.index')->with('videos', $videos);
    }

    /**
    * Jeden film
    */

    public function show($id)
    {
    	$video = Video::findOrFail($id);
    	return view('videos.show')->with('video', $video);
    }


   /**
   * Wyświetla formularz dodawania filmu
   */ 
   public function create()
   {
      $categories = Category::pluck('name','id');
   		return view('videos.create')->with('categories', $categories);
   }

   /**
   * Zapisujemy film do bazy
   */

   public function store(CreateVideoRequest $request)
   {
   		$video = new Video($request->all());
      Auth::user()->videos()->save($video);

      $categoryIds = $request->input('CategoryList');
      $video->categories()->attach($categoryIds);
      Session::flash('video_created', 'Twój film został zapisany');
   		return redirect('videos');
   }

   /**
   * Formularz edycji filmu
   */
   public function edit($id)
   {
      $categories = Category::pluck('name','id');
   		$video = Video::findOrFail($id);
   		return view('videos.edit', compact('video','categories'));
   }

   /**
   * Aktualizacja filmu
   */
   public function update($id, CreateVideoRequest $request)
   {
   		$video = Video::findOrFail($id);
   		$video->update($request->all());
      $video->categories()->sync($request->input('CategoryList'));
   		return redirect('videos');
   }
}