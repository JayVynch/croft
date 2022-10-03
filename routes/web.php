<?php

use App\Category;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Settings\SettingsController;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {

    $categories = Category::select('id','name','slug')->get();
    $questions = Question::search('title',$request->search)->where('status','approved')->get();
    
    return view('welcome', compact('categories','questions'));
});

Route::get('/questions/categories/{slug}',[ QuestionController::class, 'questionCategory'])->name('question.category');

Route::get('/new/questions',[ QuestionController::class, 'create'])->name('question.create');

Route::post('/new/questions',[ QuestionController::class, 'store']);

Route::get('/pending/{slug}',[ QuestionController::class, 'pending'])->name('pending');

Route::get('/questions/filters/{filter}',[QuestionController::class,'questionFilter'])->name('filter');

Route::get('/questions/{slug}',[ QuestionController::class, 'show'])->name('question.single');

Route::get('questions/modals',[QuestionController::class, 'modal'])->name('question.modal');

// vote

Route::post('/question/upvotes', [QuestionController::class,'upvote'])->name(('upvote'));
Route::post('/question/downvotes', [QuestionController::class,'downvote'])->name(('downvote'));

//answer

Route::post('/questions/answer/{id}', [AnswerController::class,'store'])->name(('answer'));
Route::post('/answers/comments/{id}', [CommentController::class,'store'])->name(('comment'));
// Route::post('/question/comments/{id}', [CommentController::class,'store'])->name(('comment'));

// settings

Route::get('/settings/creates/categories',[SettingsController::class,'createCategory'])->name('new.cat');
Route::post('/settings/creates/categories',[SettingsController::class,'storeCategory']);
Route::get('/settings/edits/categories/{id}',[SettingsController::class,'editCategory'])->name('category.update');
Route::post('/settings/edits/categories/{id}',[SettingsController::class,'updateCategory']);
Route::get('/settings/deletes/categories/{id}',[SettingsController::class,'deleteCategory'])->name('category.delete');

Route::get('/settings/filters/{filter}',[SettingsController::class,'filter'])->name('admin.filter');

Route::get('/settings/tags',[SettingsController::class,'tags'])->name('tags');
Route::get('/settings/edits/tags/{id}',[SettingsController::class,'editTag'])->name('tag.update');
Route::post('/settings/edits/tags/{id}',[SettingsController::class,'updateTag']);
Route::get('/settings/deleted/tags/{id}',[SettingsController::class,'deleteTag'])->name('tag.delete');

Route::get('/settings/tags/{tags}',[SettingsController::class,'showTags'])->name('question.tags');
Route::get('/settings/questions',[SettingsController::class,'question'])->name('dashboard');
Route::get('/settings/questions/new',[SettingsController::class,'addQuestion'])->name('add.question');
Route::post('/settings/questions/new',[SettingsController::class,'storeQuestion']);
Route::get('/settings/questions/view/{id}',[SettingsController::class,'showQuestion'])->name('show.question');
Route::post('/settings/questions/stage',[SettingsController::class,'stageQuestion'])->name('update.stage');
Route::get('/settings/answers',[SettingsController::class,'answer'])->name('set.answer');
Route::get('/settings/answers/view/{id}',[SettingsController::class,'showAnswer'])->name('show.answer');
Route::get('/settings/comments',[SettingsController::class,'comment'])->name('set.comment');
Route::get('/settings/comments/view/{id}',[SettingsController::class,'showComment'])->name('show.comment');
Route::post('/settings/questions/approves',[SettingsController::class,'approveQuestion'])->name('approve.question');
Route::post('/settings/answers/approves',[SettingsController::class,'approveAnswer'])->name('approve.answer');
Route::post('/settings/comments/approves',[SettingsController::class,'approveComment'])->name('approve.comment');