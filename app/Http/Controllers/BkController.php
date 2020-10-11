<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\ta;
use App\Models\pa;
use App\Models\Kelas;
use App\Models\Gurus;
use App\Models\mapels;
use App\Models\siswa;
use App\Models\Absens;
use App\Models\jurnals;
use App\Models\upload;
use App\Models\AbsenGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BkController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth','bk']);
    // }

    public function index()
    {
        $kelas = Kelas::all();
       return view('bk/index',['kelas' => $kelas]);
    }

    public function absen1($id)
    {
    	$jum = siswa::where('kelas_id', $id)->count();
        $ta = ta::where('status', 1)->first();
        $siswa = siswa::where('kelas_id', $id)->get();
        $absen = Absens::whereBetween('date',['20170809', '20170820'])
        		->where([
        				['kelas_id', $id],
        				['tas_id', $ta->id]
        				])
        		->orderBy('date', 'asc')
        		->orderBy('jam_ke', 'asc')
        		->orderBy('nisn', 'asc')
        		->paginate($jum);
        //dd($absen);
        return view('/bk/siswa',['siswas' => $absen]);
    }

    public function piket()
    {
        /*
        1. menu dengan menggunakan parameter "status",
        2. di controller menggunakan filter "status"
        */
        // butuh filter untuk agar bisa akses
        if(Auth::user()->status == 'Piket')
        {
            $ta     = ta::where('status',1)->first();
            $kelas  = Kelas::where('tas_id', $ta->id)->get();
            $mapel  = mapels::where('tas_id', $ta->id)->get();
            //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
            $guru   = Gurus::where('status','1')->orderBy('nama')->get();
            //=============================================//
            return view('bk/piketAbsen',[
              'kelass' => $kelas,
              'gurus' => $guru,
              'ta' => $ta,
              'mapels' => $mapel
            ]);
        }
        else
        {
          return redirect('/bk');
        }
    }

    public function store(Request $request)
    {

      $absenGuru = AbsenGuru::where([
        ['date', $request->date],
        ['jam_ke', $request->jam],
        ['gurus_id', $request->guru],
        ['kelas_id', $request->kelas],
        ])->count();

      if($absenGuru > 0 )
      {
        Session::flash("flash_notif",[
          "level"   => "danger",
          "message" => "Absen Guru Gagal karena guru sudah di absen di jam ini"
        ]);

        return redirect ('/bk/piket');
      }
      else
      {
      $simpan = new AbsenGuru;
      $simpan->tas_id   = $request->ta;
      $simpan->smt      = $request->smt;
      $simpan->date     = $request->date;
      $simpan->gurus_id = $request->guru;
      $simpan->mapel    = $request->mapel;
      $simpan->jam_ke   = $request->jam;
      $simpan->kelas_id = $request->kelas;
      $simpan->ket      = $request->ket;
      $simpan->catatan  = $request->catatan;
      $simpan->pengabsen  = $request->pengabsen;
      $simpan->save();

        Session::flash("flash_notif",[
          "level"   => "success",
          "message" => "Absen Guru Berhasil"
        ]);
        //dd($simpan);
      }
      return redirect ('/bk/piket');
    }

	public function show()
    {
	    if(Auth::user()->status == 'Piket')
	    {
	      $absenGuru = AbsenGuru::where('date', date('Ymd'))->orderBy('created_at')->get();
	      return view('/bk/show', ['Ag' => $absenGuru]);
	    }
	    else
	    {
			return redirect ('/bk');
		}
    }

    public function Jindex()
    {
      //=====pengisian jurnal untuk guru===//
      $kelas = Kelas::paginate(10);
      //untuk memunculkan tahun ajaran
      $ta = ta::where('status',1)->first();
      //dd($ta);
      $jurnal = jurnals::where([
        ['user', Auth::user()->name],
        ['tas_id', $ta->id],
        ['tgl', date('Ymd')]
        ])->get();
    return view('bk/Jindex', ['kelas' => $kelas, 'jurnals' => $jurnal]);
    }

    public function create($id)
    {
      //cek ta yang aktif
      $tas    = ta::where('status', 1)->first();
      //jika ta ada maka filter mapel dimana ta dan semester yang aktif, maka mapel akan di munculkan
      $mapel  = mapels::where('tas_id', $tas->id)->get();
      //cek siswa dengan parameter id kelas dan munculkan
      $siswas = siswa::where('kelas_id', $id)->get();
      return view('bk/create', ['kelas' => Kelas::findOrFail($id), 'Mapel' => $mapel, 'ta' => $tas, 'siswas' => $siswas]);
    }

    public function simpan(Request $request)
    {
      $jurnal = New jurnals;
      $jurnal->semester = $request->semester;
      $jurnal->tas_id   = $request->ta;
      $jurnal->jam_ke   = $request->jam;
      $jurnal->mapel    = $request->mapel;
      $jurnal->user     = $request->user;
      $jurnal->gurus_id = $request->user_id;
      $jurnal->hari     = $request->hari;
      $jurnal->kikd_ke  = $request->kikd;
      $jurnal->materi   = $request->materi;
      $jurnal->siswa    = $request->siswa;
      $jurnal->spi      = $request->spi;
      $jurnal->sos      = $request->sos;
      $jurnal->sikap    = $request->sikap;
      $jurnal->kelas    = $request->kelas;
      $jurnal->tgl      = $request->tgl;
      $jurnal->save();
      //dd($jurnal);
      return back();
    }

    public function absen($id)
    {
      $ta     = ta::where('status',1)->first();
      $kelas  = Kelas::where('tas_id', $ta->id);
      return View('bk/ACreateAbsen',['kelas' => Kelas::findOrFail($id), 'ta' => $ta]);
    }

    public function store1(Request $request)
    {
      //cek dulu di database where kelas = inputan kelas dan jam = inputan jam jika ada maka
      $cekAbsen = DB::table('absens')->where([
                  ['date', '>=', $request->input('date')],
                  ['kelas_id', '=', $request->input('kelas')],
                  ['jam_ke', '=', $request->input('jam')]
                  ])->count();

      if($cekAbsen > 0)
      {
        Session::flash("flash_notif",[
          "level"   => "danger",
          "message" => "Maaf kelas ini sudah di absen"
        ]);

        return back();
      }
      else
      {
        $query = DB::table('siswa')->where('kelas_id', $request->input('kelas'))->get();
        //loping semua data yang ada dari post dan simpan dengan methode menggunankan
        //array yang berada di $data[];
          foreach ($query as $list) {
            $data[] = array(
            'nisn'        => $request->input('nisn'.$list->nisn),
            'user'        => $request->input('user'),
            'kondisi'     => $request->input('radio'.$list->nisn),
            'kelas_id'    => $request->input('kelas'),
            'tas_id'      => $request->input('ta'),
            'ket'         => $request->input('ket'.$list->nisn),
            'jam_ke'      => $request->input('jam'),
            'smt'         => $request->input('smt'),
            'date'        => $request->input('date'),
            'created_at'  =>  \Carbon\Carbon::now(),
            'updated_at'  =>  \Carbon\Carbon::now(),
          );
        }
        DB::table('absens')->insert($data);

        Session::flash("flash_notif",[
          "level"   => "success",
          "message" => "Absen Berhasil"
        ]);
        return back();
      }
    }

    public function show1()
    {
        $ta     = ta::where('status',1)->first();
        $kelas  = Kelas::where('tas_id', $ta->id)->paginate(10);
        //==== filter tampilan absen agar absen di hari kemarin tidak muncul di hari ini========//
        $absens = Absens::where([
                            ['date',date('Ymd')],
                            ['user', Auth::user()->name]
                            ])->orderBy('jam_ke')->orderBy('kelas_id')->get();
        //$absens = Absens::where('date',date('Ymd'))->get();
        return view('bk/show1', ['kelas' => $kelas, 'absens' => $absens]);
    }

    public function UploadIndex()
  {
    $guru = Gurus::where('nama', Auth::user()->name)->first();
    $tas = ta::where('status', 1)->first();
    $files = upload::where([
      ['gurus_id', $guru->id],
      ['tas', $tas->id]
      ])->get();
    $mapel = mapels::all();
     return view('/bk/UploadIndex',['files' => $files, 'mapels' => $mapel]);
  }

  public function simpanUpload(Request $request)
  {
    //==================== cek ta id yang aktif ==============//
    $ta = ta::where('status', 1)->first();

    $guru_id = Gurus::where('nama', Auth::user()->name)->first();
    //============ cara membuat session di laravel ==================//
    $coba = session()->put('gurus_id', $guru_id->id);

    $this->validate($request,[
      'nama_file' => 'required',
      'nama_type' => 'required|mimes:doc,docx,xls,xlsx,pdf,ppt,pptx,rar,zip',
    ]);

    $ekstensi = $request->nama_type->getClientOriginalExtension();
    //====== mengubah nama file =====================//
    $rename = 'smansa'.rand(11111,99999). '.' . $ekstensi;

    $tempatUpload = 'upload';
    $file = $request->file('nama_type');
    $file->move($tempatUpload, $rename);

    $simpan = DB::table('uploads')->insert([
        [
          'gurus_id' => session('gurus_id'),
          'file' => $rename,
          'tas' => $ta->id,
          'nama_file' => $request->nama_file,
          'kelas' => $request->kelas,
          'mapel' => $request->mapel
        ]
      ]);
      if($simpan)
      {
        Session::flash("flash_notif",[
             "level"   => "success",
             "message" => "Upload data sukses"
           ]);
      }else {
        Session::flash("flash_notif",[
        "level"   => "danger",
        "message" => "Gagal Upload data"
        ]);
      }
    return redirect('/bk/upload');
   }

   public function FormEdit()
   {
   	$kelas = Kelas::all();
   		return view('bk/FormEdit',['kelas' => $kelas]);
   }

   public function proses(Request $request)
   {
   	$absen = Absens::whereBetween('date', [$request->tgl1, $request->tgl2])
   			->where('kelas_id', $request->kelas)
        ->orderBy('created_at')
        ->orderBy('jam_ke')
   			->get();

   	  return view('/bk/Esiswa',['absens' => $absen]);
   }

   public function FormEditId($id)
   {
     $absen = absens::where('id', $id)->first();
     return view('bk/FormEditId',["absens" => $absen]);
   }

   public function update(Request $request, $id)
   {
     $data = Absens::find($id);
     $data->kondisi   = $request->kondisi;
     $data->user      = $request->user;
     $simpan = $data->save();

     if($simpan)
     {
       Session::flash("flash_notif",[
            "level"   => "success",
            "message" => "Edit Data Sukses"
          ]);
     }else {
       Session::flash("flash_notif",[
       "level"   => "danger",
       "message" => "Gagal Edit Data"
       ]);
     }

     return Redirect ('/bk/edit');
   }

   public function Cindex()
   {
	   $kelas = Kelas::all();
       return view('/bk/Cindex',['kelas' => $kelas]);
   }

    public function Rsiswa(Request $request)
    {
        $absen = Absens::where('date', $request->tgl1)->get(array('id', 'kelas_id', 'nisn'));

        foreach($absen as $a)
        {
            echo $a->nisn;
            echo '<hr>';
        }
    }

    public function formKelas()
    {
       $bk = pa::where('guru_id', Auth::user()->id)->get();

       return view('bk.formKelas', compact('bk'));
    }

}
