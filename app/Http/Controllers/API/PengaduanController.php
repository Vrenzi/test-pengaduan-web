<?php

namespace App\Http\Controllers\API;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PengaduanController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function getByNik($nik)
    {
        $pengaduan = Pengaduan::where('nik', $nik)->get();

        if (!$pengaduan) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ], 404);
        }

        $data = [
            'status' => 200,
            'pengaduan' => $pengaduan,
        ];

        return response()->json($data, 200);
    }


    public function index()
    {
        $pengaduan = Pengaduan::all();
        $data = [
            'status' => 200,
            'pengaduan' => $pengaduan
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            // 'nama' => 'required',
            'kategori' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages()
            ];
            return response()->json($data, 422);
        }

        $pengaduan = new Pengaduan;

        $pengaduan->nik = $request->nik;
        // $pengaduan->nama = $request->nama;
        $pengaduan->kategori = $request->kategori;
        $pengaduan->isi_laporan = $request->isi_laporan;

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('pengaduan_photos', 'public'); // Store the image in the storage/foto directory
            $pengaduan->foto = $fotoPath;
        }

        $pengaduan->save();

        $data = [
            'status' => 200,
            'message' => 'Data uploaded successfully',
        ];
        return response()->json($data, 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'isi_laporan' => 'required',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {
            $pengaduan = Pengaduan::find($id);

            $pengaduan->nik = $request->nik;
            $pengaduan->isi_laporan = $request->isi_laporan;

            $pengaduan->save();

            $data = [
                'status' => 200,
                'message' => 'Data updated succesfully'
            ];
            return response()->json($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);
        $pengaduan->delete();
        $data = [
            'status' => 200,
            'message' => 'Data deleted successfully'
        ];
        return response()->json($data, 200);
    }

    public function sendImage($id)
    {
        // Assuming there is an 'id' column in the 'pengaduans' table
        // Log::info("Request to send image for ID: $id");
        $pengaduan = Pengaduan::find($id);

        if ($pengaduan && $pengaduan->foto) {
            // Get the file path from the database
            $fotoPath = $pengaduan->foto;

            // Construct the full file path
            $fullPath = public_path("/storage/$fotoPath");

            // Check if the file exists before sending it
            if (file_exists($fullPath)) {
                return response()->file($fullPath);
            } else {
                // Handle the case when the file does not exist
                abort(404, 'Image not found');
            }
        } else {
            // Handle the case when no pengaduan or foto is found
            abort(404, 'Pengaduan or Image not found');
        }
    }
}
