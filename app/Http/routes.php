<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return "This is About Page";
// });

// Route::get('/contact', function () {
//     return "This is Contact Page";
// });

// Route::get('/post/{id}', function($id){
// 	return "Post page" . $id;
// });

// Route::get('/admin/posts/example', array('as' => 'admin.home', function(){
// 	$url = route('admin.home');
// 	return "this url is". $url;
// }));

// =============================================
// Route::get('post/{id}/', 'PostsController@index');

// =============================================

// ================REsource=============================
Route::resource('posts', 'PostsController');
Route::get('/contact', 'PostsController@contact');
Route::get('/post/{id}/{name}/{password}/', 'PostsController@show_post');

// =============================================

// ===========Raw Query Database==================================
Route::get('/insert', function(){
	DB::insert('insert into posts(title, content) values(?,?)', ['PHP with laravel2', 'Laravel is the best that has happened to PHP']);
});

Route::get('/read', function(){
	$results = DB::select('select * from posts where id = ?', [1]);
	foreach ($results as $post) {
		# code...
		return $post->title;
	}
});

Route::get('/update', function(){
	$updated = DB::update('update posts set title = "Updated title" where id = ?', [1]);
	return "Updated data ID : ".$updated;
});

Route::get('/delete', function(){
	$deleted = DB::delete('delete from posts where id = ?', [1]);
	return "Data deleted by id: ". $deleted;
});
// =============================================

// =================eloquent=====================

Route::get('read1', function(){
	//$posts = App\Post;
	// or "use App\Post" in head
	$posts = App\Post::all();
	foreach ($posts as $post) {
		return $post->title;
	}
});

Route::get('find1', function(){
	$post = App\Post::find(2);
		return $post;
});

Route::get('findwhere1', function(){
	$posts = App\Post::where('id',3)->orderBy('id', 'desc')->take(1)->get();
	return $posts;
});

Route::get('findmore1', function(){
	$posts = App\Post::findOrFail(1);
	return $posts;
});

// =================================================