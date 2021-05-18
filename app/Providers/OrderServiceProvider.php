<?php

// namespace App\Providers;

// use Illuminate\Support\Facades\View;
// use Illuminate\Support\ServiceProvider;

// use Validator;
// use App\Http\Validators\OrderValidator;

// class OrderServiceProvider extends ServiceProvider
// {
//     /**
//      * Register services.
//      *
//      * @return void
//      */
//     public function register()
//     {
//         //
//     }

//     public function boot()
//     {
//         $validator = $this->app["validator"];
//         $validator->resolver(function($translator, $data,
//         $rules, $messages) {
//             return new OrderValidator($translator, $data,
//             $rules, $messages);
//         });
//         // Validator::extend('hello', function($attribute, $value,
//         // $parameters, $validator) {
//         // return $value % 2 == 0;
//         // });
//     }
// }