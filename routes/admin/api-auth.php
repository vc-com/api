<?php

$this->post('login', 'Api\V1\Admin\AuthController@login')->name('auth.login');

// $this->post('register', 'Auth\AuthController@register')->name('auth.register');
