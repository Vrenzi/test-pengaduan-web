<?php

namespace App\Http\Controllers\API;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        $data = [
            'status' => 200,
            'pengaduan' => $masyarakat
        ];
        return response()->json($data, 200);
    }

    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|unique:masyarakats',
            'nama' => 'required',
            'username' => 'required',
            'telp' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'nik.unique' => 'Nik Sudah Terdaftar'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan Registrasi',
                'data' => $validator->errors()
            ], 401);
        }
        $user = Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
        ]);

        $token = $user->createToken('personal-access-token')->plainTextToken;

        $response = [
            'status' => 200,
            'token' => $token,
            'user' => $user,
            'message' => 'Registrasi berhasil'
        ];

        return response()->json($response, 200);
    }



    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $rules = [
            'username' => 'required',
            'password' => 'required|string',
        ];
        $request->validate($rules);


        $masyarakat = Masyarakat::where('username', $username)->first();

        if (!$masyarakat || !Hash::check($password, $masyarakat->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal login. Username atau Password salah.',
            ], 401);
        }

        $token = $masyarakat->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Sukses login',
            'data' => [
                'token' => $token,
                'name' => $masyarakat->name,
            ],
        ], 200);
    }

    public function getById($id)
    {
        $masyarakat = Masyarakat::find($id);

        if (!$masyarakat) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ], 404);
        }

        $data = [
            'status' => 200,
            'masyarakat' => $masyarakat,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::find($id);
        $masyarakat->delete();
        $data = [
            'status'=>200,
            'message'=>'Data deleted successfully'
        ];
        return response()->json($data, 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sukses logout'
        ]);
    }
}
