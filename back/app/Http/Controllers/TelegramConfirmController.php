<?php

namespace App\Http\Controllers;

class TelegramConfirmController extends Controller
{
    public function index()
    {
        return view('email-confirm');
    }
}
