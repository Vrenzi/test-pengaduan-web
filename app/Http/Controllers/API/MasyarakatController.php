<?php

namespace App\Http\Controllers\Api;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class MasyarakatController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'telp' => 'required',
            'password' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {
            $masyarakat = Masyarakat::find($id);

            $masyarakat->name = $request->name;
            $masyarakat->email = $request->email;
            $masyarakat->phone = $request->phone;
            $masyarakat->password = $request->password;


            $masyarakat->save();

            $data = [
                'status' => 200,
                'message' => 'Data updated succesfully'
            ];
            return response()->json($data, 200);
        }
    }


    public function index()
    {
        $masyarakat = Masyarakat::all();
        $data = [
            'status' => 200,
            'masyarakat' => $masyarakat
        ];
        return response()->json($data, 200);
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nik' => 'required|numeric|unique:masyarakats',
            'nama' => 'required',
            'email' => 'required|email|unique:masyarakats',
            'no_telp' => 'required',
            'password' => 'required',
            // 'confirm_password' => 'required|same:password',
        ], [
            'nik.unique' => 'NIK Sudah terdaftar di database',
        ]);

        if ($validation->fails()) {
            return response()->json([

                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validation->errors(),
            ]);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $masyarakat = Masyarakat::create($input);

        $success['token'] = $masyarakat->createToken('auth_token')->plainTextToken;
        $success['nama'] = $masyarakat->nama;

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Sukses register',
            'data' => $success,
        ]);
    }


    public function login(Request $request)
    {
        try {
            // validate
            $rules = [
                'email' => 'required',
                'password' => 'required|string',
            ];
            $request->validate($rules);

            $user = Masyarakat::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Personal Access Token')->plainTextToken;
                $response = ['status' => 200, 'user' => $user, 'token' => $token, 'message' => 'login success'];
                return response()->json($response, 200);
            }

            $response = ['message' => 'Incorrect email or password'];
            return response()->json($response, 400);
        } catch (\Exception $e) {
            // Tangkap exception dan kirim respons server error
            $response = ['message' => 'Terjadi kesalahan server: ' . $e->getMessage()];
            return response()->json($response, 500);
        }
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
    public function getByNIK($nik)
    {
        $masyarakat = Masyarakat::find($nik);

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
            'status' => 200,
            'message' => 'Data deleted successfully'
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
