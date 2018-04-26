<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Monitorador\Slack\Auth\AutenticatorFacade;
use Monitorador\Slack\Auth\Code;

class AuthenticatorController extends Controller
{
    public function index(){
        return view('index', [
            'url_login'=>AutenticatorFacade::getURL()
        ]);
    }


    public function code(Request $request){
        $code = $request->get('code');

        $auth_code = new Code($code);
        $user = $auth_code->getUser();
        $user->save();

        $request->session()->put('usuario_criado', true);

        return redirect()->to('/');
    }
}
