<?php

$this->post('login', 'Api\V1\Admin\Auth\LoginController@login')
    ->name('auth.login');

$this->post('reset', 'Api\V1\Admin\Auth\ResetPasswordController@reset')
    ->name('auth.reset');

$this->post('forgot', 'Api\V1\Admin\Auth\ForgotPasswordController@forgot')
    ->name('auth.forgot');

$this->post('forgot/check/token', 'Api\V1\Admin\Auth\CkeckTokenController@check')
    ->name('auth.check.token');


// $this->post('refresh-token', 'Api\V1\Admin\Auth\RefreshTokenController@refresh')->name('auth.check.token');

// $this->post('register', 'Api\V1\Admin\Auth\RegisterController@register')->name('auth.register');
