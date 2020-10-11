<?php

namespace App\Http\Controllers;

use App\Http\Resources\suratResource;
use App\Models\image_surat;
use Illuminate\Support\Facades\File;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Models\Tu_kode;
use App\Models\surat;

use Auth;

class ApiTu extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function GetKode()
    {
        $kode = Tu_kode::paginate(3);

        return suratResource::collection($kode);
        // return response()->json([
        //     'data' => $kode
        // ]);
    }

    public function saveKode(Request $request)
    {
        $this->validate($request, [
            'kat' => 'required|unique:tu_kode_surat',
            'kode' => 'required|unique:tu_kode_surat',
        ]);


        $simpan = Tu_kode::create([
            'kat' => $request->kat,
            'kode' => $request->kode,
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'data'  => $simpan,
            'message'   => 'success'
        ], 201);
    }

    public function delete($id)
    {
        //        $data = surat::where('id', $id)->first();
        //        $path = public_path().'/image_surat/'.$data->image;
        //        File::delete($path);

        $delete = Tu_kode::where('id', $id)->delete();

        return response()->json([
            'message' => 'sukses delete'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kat' => 'required',
            'kode' => 'required',
        ]);

        $update = Tu_kode::findOrFail($id);
        $update->kat = $request->kat;
        $update->kode = $request->kode;

        $update->save();

        return response()->json([
            'data' => $update,
            'message' => 'success'
        ], 201);
    }

    public function kategori()
    {
        $kat = Tu_kode::all();

        return response()->json([
            'data' => $kat
        ]);
    }

    public function saveSurat(Request $request)
    {
        $this->validate($request, [
            'tgl'       => 'required',
            'list'      => 'required',
            'desk'      => 'required',
            'ns'        => 'required|unique:surats',
            'image'     => 'required',
            'ket'       => 'required'
        ]);


        $simpan = surat::create([
            'tgl'       => $request->tgl,
            'kode_id'   => $request->list,
            'ns'        => $request->ns,
            'desk'      => $request->desk,
            'gambar'    => $request->image,
            'ket'       => $request->ket
        ]);


        return response()->json([
            'data' => $simpan
        ], 200);
    }

    public function saveImage(Request $request)
    {
        dd($request);
        $surat_id = surat::latest()->first();

        $cek = image_surat::where('surat_id', $surat_id->id)->count();

        if ($cek === 0) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/image_surat'), $image);

            $simpan           = new image_surat();
            $simpan->surat_id = $surat_id->id;
            $simpan->name     = $image;
            $simpan->save();

            return response()->json([
                'data' => $simpan
            ], 200);
        }
    }

    public function shi()
    {
        $surat = surat::with('kategoris')->whereDate('created_at', date('Y-m-d'))->get();

        return response()->json([
            'data' => $surat
        ], 200);
    }

    public function dels($id)
    {
        $del = surat::where('id', $id)->delete();

        return response()->json([
            'data' => $del
        ], 200);
    }
}
