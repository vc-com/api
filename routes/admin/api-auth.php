<?php

$this->post('login', 'Api\V1\Admin\AuthController@login')->name('auth.login');
$this->post('reset', 'Api\V1\Admin\AuthController@reset')->name('auth.reset');
$this->post('forgot', 'Api\V1\Admin\AuthController@forgot')->name('auth.forgot');
$this->post('forgot/check/token', 'Api\V1\Admin\AuthController@checkToken')->name('auth.check.token');

// $this->post('register', 'Auth\AuthController@register')->name('auth.register');
