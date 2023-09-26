<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Debitur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DebitursController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $debitur = Debitur::all();
        return response([
            'success' => true,
            'message' => 'List Debiturs',
            'data' => $debitur
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'no_cif'        => 'required',
                'nama_debitur'  => 'required',
            ],
            [
                'no_cif.required' => 'Masukkan no cif',
                'nama_debitur.required' => 'Masukkan nama debitur',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi bidang yang kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $debitur = Debitur::create([
                'no_cif'        => $request->input('no_cif'),
                'nama_debitur'  => $request->input('nama_debitur')
            ]);

            if ($debitur) {
                return response()->json([
                    'success' => true,
                    'message' => 'Debitur berhasil disimpan',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Debitur gagal disimpan',
                ], 401);
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $debitur = Debitur::whereId($id)->first();

        if ($debitur) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Debitur',
                'data'    => $debitur
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Debitur tidak ada!',
                'data'    => ''
            ], 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'no_cif'        => 'required',
                'nama_debitur'  => 'required',
            ],
            [
                'no_cif.required'       => 'Masukkan no cif',
                'nama_debitur.required' => 'Masukkan nama debitur',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi bidang yang kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $debitur = Debitur::whereId($request->input('id'))->update([
                'no_cif'        => $request->input('no_cif'),
                'nama_debitur'  => $request->input('nama_debitur'),
            ]);

            if ($debitur) {
                return response()->json([
                    'success' => true,
                    'message' => 'Debitur berhasil diupdate',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Debitur gagal diupdate',
                ], 401);
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $debitur = Debitur::findOrFail($id);
            $debitur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Debitur berhasil dihapus',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Debitur gagal dihapus',
            ], 404);
        }
    }
}
