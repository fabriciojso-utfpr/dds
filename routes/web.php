<?php

Route::get('/', "AuthenticatorController@index");
Route::get('/code', "AuthenticatorController@code");

Route::get('/monitor', "MonitorController@index");

Route::get('/lista', function(){
    dd(\App\User::all());
});