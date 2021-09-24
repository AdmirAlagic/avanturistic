<?php


//user verified routes

Route::get('/email-preferences', 'PublicController@unsubscribe');
Route::post('/postUnsubscribe', 'PublicController@postUnsubscribe');
Route::get('/privacy-policy', 'PublicController@privacy');
Route::get('/terms-and-conditions', 'PublicController@terms');

Route::get('/share', 'PostController@create');
Route::get('/profile', 'ProfileController@privateProfile')->name('profile');
Route::get('/switch-to-businesss', 'ProfileController@switchToBusiness');
//Route::group(['middleware'=> 'verified'], function(){
//});
Route::get('/my-adventures', 'PublicController@myPosts');
Route::get('/search', 'PublicController@search')->name('search');
Route::get('/postSearch', 'PublicController@postSearch')->name('postSearch');
Route::get('/favorites', 'PublicController@favorites')->name('favorites');
Route::get('/favorite-users', 'PublicController@allFavorites')->name('all-favorites');

Route::get('message/{id}', 'ProfileController@getMessage');
Route::post('sendMessage', 'ProfileController@postMessage');
Route::get('messages', 'ProfileController@messages');
Route::get('/profile/change-password', 'ProfileController@changePassword');
Route::post('/profile/change-password', 'ProfileController@postChangePassword');
Route::get('notifications', 'ProfileController@notifications');

//Posts
Route::resource('posts', 'PostController');
Route::get('/adventure/{id}/timelapse', 'PostController@createTimelapse');
Route::get('/adventure/{id}/edit', 'PostController@edit');
Route::get('/adventure/{id}/report', 'PostController@report');
Route::get('/adventure/{id}/next', 'PostController@nextPost');
Route::post('post/comment', 'PostController@comment');
Route::post('post/like', 'PostController@like');
Route::post('post/visited', 'PostController@visited');
Route::post('comments/{id}/delete', 'PostController@deleteComment');

//Timelapses
Route::get('my-timelapses', 'TimelapseController@index');
Route::post('deleteTimelapse', 'TimelapseController@delete');
Route::get('create-timelapse', 'TimelapseController@create');
Route::post('create-timelapse', 'TimelapseController@storeTimelapse')->name('timelapse.store');
Route::post('timelapse/like', 'TimelapseController@like')->name('timelapse.like');
Route::get('download-timelapse/{id}', 'TimelapseController@downloadTimelapse');
Route::get('timelapse/{id}/visibility', 'TimelapseController@changeVisibility');

//public routes

Route::get('/', 'PublicController@index')->name('home');
Route::get('/highlights', 'PublicController@highlights')->name('highlights');
Route::get('/the-world-map-of-outdoor-adventures', 'PublicController@map')->name('map');
Route::get('/outdoor-adventures', 'PublicController@adventures')->name('adventures');
/* Route::get('/adventures/activities', 'PublicController@activities')->name('activities');
 */Route::get('/outdoor-adventures/{slug}', 'PublicController@activity');
/* Route::get('/avanturistic-map-shareable', 'PublicController@shareableMap');
Route::get('/avanturistic-map-shareable-view', 'PublicController@shareableMapView');
 */
Route::get('/countries/', 'PublicController@countries');
Route::get('/country/{slug}', 'PublicController@country');
Route::get('/profile/{id}', 'ProfileController@edit')->name('profile.edit');
Route::post('/updateProfile', 'ProfileController@updateProfile')->name('profile');
//Route::get('/popular', 'PublicController@popular')->name('popular');
Route::get('/watch', 'PublicController@videos')->name('videos');

Route::get('/adventurist/{id}/{slug}', 'ProfileController@publicProfile');
Route::get('/support', 'ProfileController@publicProfile');
Route::get('block-user/{id}', 'ProfileController@blockUser');


Route::post('getPosts', 'PostController@getPosts');
Route::get('adventure/{id}/{slug?}/{next?}', 'PostController@show');


//Blog
Route::resource('blog', 'BlogController');

Route::get('/stories', 'PublicController@blog')->name('blog');
Route::get('my-experiences', 'BlogController@index');
Route::get('my-experiences/{id}/edit', 'BlogController@edit');
Route::get('my-experiences/{id}/publish', 'BlogController@publish');
Route::get('new-experience', 'BlogController@create');
Route::post('blog/like', 'BlogController@like');
Route::post('blog/comment', 'BlogController@comment');

//admin

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::resource('/', 'Admin\AdminController');
    Route::resource('/users', 'Admin\AdminUsersController');
    Route::get('/users/{id}/fcm', 'Admin\AdminUsersController@fcmForm')->name('fcm.form');
    Route::post('/users/fcm', 'Admin\AdminUsersController@sendFcm')->name('fcm.send');
    Route::resource('/posts', 'Admin\AdminPostsController');
    Route::get('/posts/{id}/mark-as-featured', 'Admin\AdminPostsController@markAsFeatured');
    Route::get('/loginAsUser/{id}', 'Admin\AdminUsersController@loginAsUser');
    Route::resource('/notifications', 'Admin\NotificationsController');
    Route::resource('/newsletter', 'Admin\NewsletterController');
    Route::resource('/quotes', 'Admin\QuotesController');
    Route::resource('/categories', 'Admin\CategoryController');
    Route::resource('/comments', 'Admin\CommentsController');
    Route::get('/comments/{id}/approve', 'Admin\CommentsController@approve');
    Route::get('/getFailedEmails', '\App\Repositories\SendEmailRepository@getFailedEmails');
    Route::get('/resendEmail/{model_id}/{failed_email_id?}', '\App\Repositories\SendEmailRepository@resendEmail');
});

Auth::routes(['verify' => true]);
Route::post('login', 'Auth\LoginController@authenticate');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('sign-up', 'Auth\RegisterController@getRegister');
Route::post('asyncRegister', 'Auth\RegisterController@asyncRegister');
 
//Socialite
Route::get('login/{driver}', 'Auth\OAuthLoginController@redirectToProvider');
Route::get('login/{driver}/callback', 'Auth\OAuthLoginController@handleProviderCallback');

//Upload
Route::get('encodeImages', 'Tools\UploadController@encodeImages');
Route::post('uploads', 'Tools\UploadController@postUpload');
Route::delete('uploads', 'Tools\UploadController@deleteUpload');


//Ajax

Route::post('deletePost', 'AjaxController@deletePost');
Route::post('deleteComment', 'AjaxController@deleteComment');
Route::get('/getCountryGeometry', 'AjaxController@getCountryGeometry');
Route::post('/getRandomImage', 'AjaxController@getRandomImage');
Route::post('/removeNotifications', 'AjaxController@removeNotifications');
Route::post('/getFavoritesView', 'AjaxController@getFavoritesView');
Route::get('/getLastMessagesView', 'AjaxController@getLastMessagesView');
Route::post('/getSingleMessageView', 'AjaxController@getSingleMessageView');
Route::get('/getAllMessagesView', 'AjaxController@getAllMessagesView');
Route::get('/searchUsers', 'AjaxController@searchUsers');
Route::get('/getPostsByLocation', 'AjaxController@getPostsByLocation');
Route::get('/getPostsByLocationData', 'AjaxController@getPostsByLocationData');

Route::get('/getUserLocation', 'AjaxController@getUserLocation');
Route::post('/setUserLocation', 'AjaxController@setLocation');
Route::post('/addToFavorites', 'AjaxController@addRemoveUserFromFavorites');
Route::post('/getProfilePosts', 'AjaxController@getProfilePosts');
Route::get('/getFavoritesPosts', 'AjaxController@getFavoritesPosts');
Route::get('/getBadges', 'AjaxController@getBadges');
Route::post('/getProfileActivity', 'AjaxController@getProfileActivity');
Route::post('/getProfileBlog', 'AjaxController@getProfileBlog');
Route::post('/saveVisitedCountry', 'AjaxController@saveVisitedCountry');
Route::get('/getVisitedCountries', 'AjaxController@getVisitedCountries');
Route::post('/getPost', 'AjaxController@getPost');
Route::post('/fbLogin', 'AjaxController@fbLogin');
Route::post('/googleLogin', 'AjaxController@googleLogin');

Route::get('@{slug}', 'ProfileController@publicProfile');
Route::get('/{slug}', 'BlogController@show');
