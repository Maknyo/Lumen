<?php


namespace App\Http\Controllers;


use Exception;
use App\Constants\DBCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Users;

class AuthController extends Controller
{

    public function __construct()
    {
   
    }

    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
        	'fullname' => 'required|string',
            'username' => 'required|string',
            'userpassword' => 'required|string',
        ]);

        try 
        {
            $user = new Users;
            $user->fullname= $request->input('fullname');
            $user->username= $request->input('username');
            $user->userpassword = app('hash')->make($request->input('userpassword'));
            $user->save();

            return response()->json( [
                        'entity' => 'users', 
                        'action' => 'create', 
                        'result' => 'success'
            ], 201);

        } 
        catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'users', 
                       'action' => 'create', 
                       'result' => 'failed'
            ], 409);
        }
    }

    public function login(Request $req)
    {
        try {

            $this->customValidate($req->all(), array(
                'username' => 'required|string',
                'userpassword' => 'required|string',
            ));

            $credentials = $req->only(['username', 'userpassword']);

            if (! $token = Auth::attempt($credentials)) {
                throw new Exception("Nama pengguna atau kata sandi tidak ditemukan", DBCode::AUTHORIZED_ERROR);
            }

            $response = \auth()->Users();
            $response['token'] = $token;

            return $this->jsonSuccess(null, $response);
        } catch (Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function me()
    {
        try {
            return $this->jsonSuccess(null, \auth()->Users());
        } catch (Exception $e) {
            return $this->jsonError($e);
        }
    }
}
