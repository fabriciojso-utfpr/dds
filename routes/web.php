<?php

Route::get('/', "AuthenticatorController@index");
Route::get('/code', "AuthenticatorController@code");

Route::get('/monitor', "MonitorController@index");