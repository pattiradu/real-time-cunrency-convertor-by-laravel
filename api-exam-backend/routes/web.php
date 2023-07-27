<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\currencyConverterForm;


Route::get('/currency-converter', [currencyConverterForm::class, 'index']);
Route::post('/currency-converter', [currencyConverterForm::class, 'convertCurrency'])->name('convertCurrency');


