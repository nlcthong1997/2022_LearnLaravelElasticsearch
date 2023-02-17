<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'Wellcome';
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/add-index', function () {
    Post::createIndex($shards = null, $replicas = null);
    
    Post::addAllToIndex();

    // $post = Post::all();
    // $post->addToIndex();
    
    return 'added index';

})->middleware('api');


Route::get('/search', function () {
    $posts = Post::searchByQuery(array('match' => array('author' => 'DDS')));
    return $posts;
})->middleware('api');