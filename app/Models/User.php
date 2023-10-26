<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
        public function validar (Request $request){
        $salida = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email'
        ]);
        if ($salida->fails()){
            $status = 0;
            $error = $salida->errors();
        }else{
            $status = 1;
            $error = "ok";
        };
        return [
            'status' => $status,
            'error' => $error
        ];
    }
    public function validar_repassword(Request $request){
            $status = 1;
            $error = "";
        $validacion = Validator::make($request->all(),[
            'email' => 'required|email',
            'password_actual' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validacion->fails()){
            $status = 0;
            $error = $validacion->errors();
        }else{
            $data = User::where('email',$request->email)->get();

            if(!Hash::check($request->password_actual,$data[0]->password)){
                $status =0;
                $error = "Verificar email o password actual";
            }

        }
        return ['status' =>$status,'error'=>$error];
    }
    public function store_repassword(Request $request){
        $status = 1;
        $error = "ok";
        try {
           user::updateOrCreate(['email' =>$request->email],['password' => Hash::make($request->password)]);
        } catch (Exception $e) {
            $status = 0;
            $error = $e->getMessage();
        }
        return ['status'=>$status,'error'=>$error];
    }
    public function get_list($condicion){
        return User::all();
    }
    public function store(Request $request){
        $status = 1;
        $error = "ok";
        try {
            User::updateOrCreate(['id' => $request->id],['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        } catch (Exception $e) {
            $status = 0;
            $error = $e->getMessage();
        }
        return [
            'status' => $status,
            'error' => $error
        ];
    }

    public function remove_item(Request $request){
        $status = 1;
        $error ="ok";
        try {
            User::destroy($request->id);
        } catch (Exception $e) {
            $status = 0;
            $error =$e->getMessage();
        }
        return [
            'status'=>$status,
            'error' => $error
        ];
    }
    public function init_session(Request $request){
        $salida = "";
        $user = User::where('email',$request->email)
                      ->Leftjoin('habilidades','habilidades.user_iduser','users.id')
                      ->get();
        if (isset($user[0]['id'])){
            if(Hash::check($request->password,$user[0]->password)){
                $habilidades = explode(',',$user[0]->habilidades);
                $token = $user[0]->createToken('auth_token',$habilidades)->plainTextToken;
                $salida = $token;
            }
        }
        return $salida;
    }
    public function close_session(){
        auth()->user()->currentAccessToken()->delete();
    }
}
