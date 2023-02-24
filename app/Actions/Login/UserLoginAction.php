<?php

namespace App\Actions\Login;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
// use Lorisleiva\Actions\Concerns\AsAction;

final class UserLoginAction
{
    // use AsAction;
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $this->login();
    }

    private function login()
    {
       
    }

}
