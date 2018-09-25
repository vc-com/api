<?php
// $this->group(['middleware' => ['jwt.auth']], function () {



// });

$this->resource('/customers', 'Api\V1\Admin\CustomerController')->except([
 	'create', 'edit'
]);
;
