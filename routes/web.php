<?php

use App\Http\Controllers\ApiController;
use App\Notifications\TaskComplate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;

// Config::set('debugbar.enabled', false);
Route::get('/', function () {
    return view('welcome');
});

// Route::get('admin/read', function () {
//     Auth::user()->unreadNotifications->markAsRead();
//     // Auth::user()->notifications()->delete();

//     return back();
// });


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Auth::routes();
//membuat route nya denah
Route::get('/denah', 'denahController@index');
Route::post('admin/pm', 'adminController@pm');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', function () {
        return view('/admin/layouts');
    });

    /* admin sma 6*/
    Route::get('admin/allUser', 'adminSmaController@index');

});

//=================ROUTE GURU =============================//
Route::group(['middleware' => ['guru']], function () {
    //routenya absen
    //Route::resource('guru', 'KguruController');
    /*============= profile peserta didik guru ====================*/
    Route::get('guru/sks/setKd', 'profSiswa@index');
    Route::post('guru/sks/simpSetKD', 'profSiswa@sim');
    Route::get('guru/sks/dl/{id}', 'profSiswa@del');
    Route::get('guru/sks/fmkls', 'profSiswa@indexKls');
    Route::get('guru/sks/mycourse/{klsid}', 'profSiswa@indexPen');
    Route::post('guru/sks/simppd', 'profSiswa@simppd')->name('simppdg');
    Route::get('guru/sks/cekProf', 'profSiswa@cekProf');
    Route::post('guru/sks/hitung', 'profSiswa@hitung')->name('hitung');
    Route::get('guru/sks/eximp', 'profSiswa@eximp');
    Route::post('guru/sks/ex', 'profSiswa@export')->name('exp1');
    Route::post('guru/sks/impExcel', 'profSiswa@import')->name('impExcel1');

    Route::post('guru/sks/api', 'ApiController@kd');
    Route::post('guru/sks/smt1', 'ApiController@smt');
    Route::post('guru/sks/npk', 'ApiController@npk');
    /*=============================================================*/
    Route::post('/guru/klsSmt', 'ApiController@klsSmt');

    /*============================soal==============================*/
    Route::get('/guru/eva/test', 'QuisController@test');
    Route::post('guru/saveSoal', 'QuisController@saveSoal');
    Route::get('/guru/eva/view', 'QuisController@view');
    Route::get('/guru/eva/inputKd', 'QuisController@inputKd');
    Route::post('/guru/eva/saveKd', 'QuisController@saveKd');
    Route::get('/guru/del/kd/{id}', 'QuisController@delKd');
    Route::delete('/guru/del/soal/{id}', 'QuisController@delsoal');
    Route::put('/guru/edit/soal/{id}', 'QuisController@editSoal');
    Route::put('/guru/update/soal/{id}', 'QuisController@updateSoal');
    Route::get('/guru/eva/upKisi', 'QuisController@uploadKisi');
    Route::post('/guru/eva/uploadKisi', 'QuisController@upKisi');
    Route::get('/guru/eva/kisi/{id}', 'QuisController@downloadKisi');
    Route::get('/guru/eva/delKisi/{id}', 'QuisController@delKisi');


    /*=================================================================*/

    /*===================== asisten Kurikulum ==========================*/
    Route::get('/guru/kurikulum/cekSoal', 'asistenController@index');
    Route::get('/guru/kurikulum/cekKisi', 'asistenController@kisiSoal');
    Route::get('/guru/kurilukum/downFile/{id}', 'asistenController@downFile');
    Route::get('/guru/kurikulum/cekPerangkat', 'asistenController@perangkat');
    Route::get('/guru/kurikulum/penelaah', 'asistenController@penelaah');
    Route::post('admin/asisten/api/', 'asistenController@guru');
    Route::get('/guru/asisten/penulis/{id}', 'asistenController@penulisSoal');
    Route::post('/guru/asisten/validasi', 'asistenController@validasi');
    Route::get('guru/kurikulum/remainders', 'asistenController@remainders');
    Route::get('guru/asistenReminder/{id}', 'asistenController@trxReminder');
    Route::get('guru/asistenReminder/{id}', 'asistenController@trxReminder');
    Route::get('guru/kurikulum/ptm', 'asistenController@ptm');


    Route::get('guru/evaluasi/soalnya', 'KguruController@soalnya');
    Route::get('guru/evaluasi/soalnya', 'KguruController@soalnya');
    Route::post('guru/eva/mapels', 'KguruController@mapels');
    Route::get('guru/evaluasi/uploadRapor', 'KguruController@uploadRapor');
    Route::post('guru/evaluasi/kelas_id', 'KguruController@kelas_id');
    Route::put('guru/evaluasi/saveFileRapor', 'KguruController@saveFileRapor');
    Route::get('guru/evaluasi/HUR', 'KguruController@HUR');
    Route::get('guru/evaluasi/hur/del/{id}', 'KguruController@delHur');
    Route::post('/guru/eva/upSatu', 'KguruController@upSatuRapor');
    Route::post('/guru/evaluasi/saveSatuFileRapor', 'KguruController@saveSatuFileRapor');
    /*-------------------------------------------------------------------*/

    Route::post('/guru/update', 'KguruController@updatePass');
    Route::post('guru/jurnal/save', 'KguruController@simpan');
    Route::get('guru/kelas/{id}', 'KguruController@absen');
    Route::post('guru', 'KguruController@store');
    Route::get('guru/jurnal', 'KguruController@Jindex');
    Route::get('guru/jurnal/cetak', 'KguruController@cetak');
    Route::get('guru/form', 'KguruController@formPass');
    Route::get('guru/absen', 'KguruController@show');
    Route::get('/guru/absen/delJam/{jam}', 'KguruController@delJam');
    Route::get('guru/uploadG', 'KguruController@UploadIndex');
    Route::post('/guru/simpanUpload', 'KguruController@simpanUpload');
    Route::get('/guru/edit/{id}', 'KguruController@edit');
    Route::put('/guru/update/{id}', 'KguruController@updateSiswa');
    Route::get('/guru/editJur/{id}', 'KguruController@editJ');
    Route::post('/guru/delete/{id}', 'KguruController@hapus');
    Route::post('/guru/del/{id}', 'KguruController@hapusUpload');
    Route::post('/guru/simUH', 'sksController@simUH');

    Route::get('/guru', 'AdminAbsenController@index');
    Route::get('/guru/AdminAbsen/kelas/{id}', 'AdminAbsenController@absen');
    Route::get('/guru/jurnal/kelas/{id}', 'JurnalController@create');
    Route::post('/guru/AdminAbsen', 'AdminAbsenController@store');
    Route::post('/guru/AdminAbsen/kbdrOrPrestasi', 'AdminAbsenController@store1');
    Route::post('/guru/jurnal', 'JurnalController@store');
    Route::get('/guru/dokumen', 'KguruController@doc');
    Route::get('admin/AdminAbsen/RGBulanan', 'AdminAbsenController@RGB');

    //================== sks ==================//
    Route::get('/guru/sks', 'sksController@index');
    Route::get('/guru/sks/tempSks/{id}', 'sksController@rancMapel');
    Route::get('/guru/sks/Pukbm', 'sksController@Pukbm');
    Route::get('/guru/sks/formAdd', 'sksController@formUkbm');
    Route::post('/guru/sks/savePen', 'sksController@save');
    Route::get('/guru/sks/formAddKD', 'sksController@addKD');
    Route::post('/guru/sks/addKD', 'sksController@save1');
    Route::post('/guru/sks/addUkbm', 'sksController@SaveUkbm');
    Route::get('/guru/sks/hasil', 'sksController@hasil');
    Route::post('/guru/detail', 'sksController@detail')->name('detail');
    Route::get('/guru/detail', 'sksController@detail');
    Route::get('/guru/sks/update/{kd}/{nis}', 'sksController@formUpt');
    Route::put('/guru/sks/update/', 'sksController@update')->name('update');
    Route::get('/guru/sks/up', 'sksController@indexUp');
    Route::get('/guru/sks/lengkap', 'sksController@lengkap');
    Route::post('/guru/sks/olah', 'sksController@olah')->name('olah');
    Route::get('/guru/sks/formuh', 'sksController@formUh');
    Route::post('/guru/sks/showKelas', 'sksController@kelasid');
    Route::get('/guru/sks/showKelas/{kelas_id}', 'sksController@showKelas')->name('showKelas');
    Route::post('/guru/simUH', 'sksController@simUH');
    Route::get('/guru/sks/up', 'sksController@indexUp');
    Route::put('/guru/sks/updateUH', 'sksController@updateUH');
    Route::post('/guru/sks/saveUp', 'sksController@saveUp');
    Route::post('/guru/sks/hapusUpload/{id}', 'sksController@hapusUpload');
    Route::post('/guru/sks/inFile', 'sksController@infile');
    Route::get('/guru/sks/inKel', 'sksController@inkel');
    Route::get('/guru/sks/penkd/{kls}/{smt}', 'sksController@showPenKd');
    Route::post('/guru/sks/header', 'sksController@header');
    Route::get('/guru/cetak/profile', 'sksController@pk');
    Route::post('guru/cetakProf', 'sksController@cetakProf');
    Route::get('guru/cetak/{smt}/{nis}', 'sksController@cetakFix');
    Route::get('guru/sks/penH', 'sksController@penH');
    Route::post('guru/sks/penilaian', 'sksController@penilaian1');

    Route::get('/guru/cekNilai', 'BkController@formKelas');
    Route::get('/guru/sks/showKelasSks/{id}', 'sksController@showKelasSksid');
    /** profile peserta didik **/
    Route::get('guru/sks/formKD', 'sksController@formKD');
    Route::post('/guru/sks/sKD', 'sksController@sKD')->name('saveSkd');
    Route::get('guru/sks/penilaian', 'sksController@penilaian');

    Route::get('guru/sks/cekPro', 'sksController@indexKelas');
    Route::post('guru/sks/cekpronya', 'sksController@cekPro')->name('guru.cekPro');
    Route::get('guru/cetak/{smt}/{nis}', 'sksController@cetakFix');
    Route::get('guru/downloadSiswa/{id}', 'adminController@downloadSiswa');

    /*======================= PJJ =====================================*/
    Route::get('guru/pjj', 'sksController@pjj');
    Route::post('guru/imateri', 'sksController@imateri');
    Route::get('guru/mi/{id}/del', 'sksController@delMateri');
    Route::get('guru/trial', 'sksController@trial');


    Route::get('guru/asdfasfasf', 'ApiController@asdfasfasf');
    Route::post('guru/aklioasfm', 'ApiController@aklioasfm');

    /*======================= Point Siswa ==============================*/
    Route::get('guru/Cpoin', 'PointController@index');
    Route::post('guru/simTatib', 'PointController@simpan');
    Route::get('guru/jumpoin', 'PointController@jumpoin');
    Route::get('guru/dPoint/{nis}', 'PointController@dPoint');
    Route::get('/guru/Ppoint', 'PointController@Ppoint');
    Route::post('guru/prosesCetak', 'PointController@cetak');
    Route::get('guru/casisLeng', 'KguruController@casisLeng');

    Route::get('guru/koperasi', 'adminController@koperasi');


    /* =========================== REMAINDER =================== */
    Route::get('api/guru/topiks', 'ApiController@GetTopiks');
    Route::post('api/guru/saveRem', 'asistenController@saveRem');
    Route::put('api/guru/editRem', 'asistenController@editRem');
    Route::put('api/guru/updateRem', 'asistenController@updateRem');
    Route::post('api/guru/saveTrx', 'asistenController@saveTrx');
    Route::get('api/guru/getTrx', 'asistenController@getTrx');

    /**---------------- GURU BK ------------------------- */
    Route::get('guru/bk', 'guruBkController@index');
});

//================= ROUTE PIKET=================================//
Route::group(['middleware' => ['piket']], function () {
    Route::get('piket/jurnal/cetak', 'PiketController@cetak');
    Route::post('piket/jurnal/save', 'PiketController@simpan');
    Route::get('piket/jurnal', 'PiketController@Jindex');
    Route::post('piket/jurnal/save', 'PiketController@simpan');
    Route::get('piket/Absenssiswa', 'PiketController@AbsenSiswa');
    Route::post('/piket', 'PiketController@store1');
    Route::get('/piket', 'PiketController@index');
    Route::get('/piket/show', 'PiketController@show');
    Route::get('/piket/absen', 'PiketController@show1');
    Route::get('piket/{id}/edit', 'PiketController@edit');
    Route::put('piket/{id}', 'PiketController@update');
    Route::get('piket/upload', 'PiketController@UploadIndex');
    Route::post('/piket/simpanUpload', 'PiketController@simpanUpload');
    Route::get('piket/edit/{id}', 'PiketController@editSiswa');
    Route::put('/piket/update/{id}', 'PiketController@update2');
    Route::post('/piket/simpnguru', 'PiketController@store');
    Route::get('piket/jurnal/kelas/{id}', 'JurnalController@create');
    Route::get('/piket/kelas/{id}', 'AdminAbsenController@absen');
    Route::post('/piket/AdminAbsen', 'AdminAbsenController@store');
    Route::post('/piket/jurnal', 'JurnalController@store');

    //================== sks ==================//
    Route::get('/piket/sks', 'sksController@index');
    Route::get('/piket/sks/tempSks/{id}', 'sksController@rancMapel');
    Route::get('/piket/sks/Pukbm', 'sksController@Pukbm');
    Route::get('/piket/sks/formAdd', 'sksController@formUkbm');
    Route::post('/piket/sks/savePen', 'sksController@save');
    Route::get('/piket/sks/formAddKD', 'sksController@addKD');
    Route::post('/piket/sks/addKD', 'sksController@save1');
    Route::post('/piket/sks/addUkbm', 'sksController@SaveUkbm');
    Route::get('/piket/sks/hasil', 'sksController@hasil');
    Route::post('/piket/detail', 'sksController@detail')->name('detail');
    Route::post('/piket/detail', 'sksController@detail')->name('detail');
    Route::post('/piket/simUH', 'sksController@simUH');
    Route::get('/piket/detail', 'sksController@detail');
    Route::get('/piket/sks/update/{kd}/{nis}', 'sksController@formUpt');
    Route::put('/piket/sks/update/', 'sksController@update')->name('update');
    Route::get('/piket/sks/lengkap', 'sksController@lengkap');
    Route::post('/piket/sks/olah', 'sksController@olah')->name('olah');
    Route::get('/piket/sks/formuh', 'sksController@formUh');
    Route::post('/piket/sks/showKelas', 'sksController@showKelas')->name('showKelas');
    Route::get('/piket/sks/up', 'sksController@indexUp');
    Route::post('/piket/sks/saveUp', 'sksController@saveUp');
    Route::post('/piket/sks/hapusUpload/{id}', 'sksController@hapusUpload');
    Route::post('/piket/sks/inFile', 'sksController@infile');
    Route::get('/piket/sks/inKel', 'sksController@inkel');
    Route::get('/piket/sks/penkd/{kls}/{smt}', 'sksController@showPenKd');
    Route::post('/piket/sks/header', 'sksController@header');
});

//================ ROUTE BK ============================//
Route::group(['middleware' => ['bk']], function () {
    Route::get('bk', 'BkController@index');
    //Route::get('/bk/kelas/{id}', 'BkController@create');
    Route::get('/bk/piket', 'BkController@piket');
    Route::post('/bk/simpanAg', 'BkController@store');
    Route::get('/bk/show', 'BkController@show');
    Route::get('/bk/jurnal', 'BkController@Jindex');
    Route::get('/bk/jurnal/kelas/{id}', 'BkController@create');
    Route::post('/bk/jurnal/save', 'BkController@simpan');
    Route::get('/bk/kelas/{id}', 'BkController@absen');
    Route::post('/bk/simpAbsen', 'BkController@store1');
    Route::get('/bk/absen', 'BkController@show1');
    Route::get('/bk/upload', 'BkController@UploadIndex');
    Route::post('/bk/simpanUpload', 'BkController@simpanUpload');
    Route::get('/bk/edit', 'BkController@FormEdit');
    Route::post('/bk/edit/kls/cari', 'BkController@proses');
    Route::get('/bk/edit/id/{id}', 'BkController@FormEditId');
    Route::put('/bk/update/{id}', 'BkController@update');
    Route::get('/bk/cetak', 'BkController@Cindex');

    //================== sks ==================//
    Route::get('/bk/sks', 'sksController@index');
    Route::get('/bk/sks/tempSks/{id}', 'sksController@rancMapel');
    Route::get('/bk/sks/Pukbm', 'sksController@Pukbm');
    Route::get('/bk/sks/formAdd', 'sksController@formUkbm');
    Route::post('/bk/sks/savePen', 'sksController@save');
    Route::get('/bk/sks/formAddKD', 'sksController@addKD');
    Route::post('/bk/sks/addKD', 'sksController@save1');
    Route::post('/bk/sks/addUkbm', 'sksController@SaveUkbm');
    Route::get('/bk/sks/hasil', 'sksController@hasil');
    Route::post('/bk/detail', 'sksController@detail')->name('detail');
    Route::post('/bk/detail', 'sksController@detail')->name('detail');
    Route::get('/bk/detail', 'sksController@detail');
    Route::get('/bk/sks/update/{kd}/{nis}', 'sksController@formUpt');
    Route::put('/bk/sks/update/', 'sksController@update')->name('update');
    Route::get('/bk/sks/lengkap', 'sksController@lengkap');
    Route::post('/bk/sks/olah', 'sksController@olah')->name('olah');
    Route::get('/bk/sks/formuh', 'sksController@formUh');
    Route::post('/bk/sks/showKelas', 'sksController@showKelas')->name('showKelas');

    Route::get('/bk/indexKelas', 'administrasiController@indexKelas');
    Route::post('/bk/redir', 'administrasiController@redir');
    Route::get('/bk/redir/{kls}', 'administrasiController@show');
    Route::get('/bk/formUpsis/{nis}', 'administrasiController@pindah');
    Route::put('/bk/UpKlsSis', 'administrasiController@update');

    Route::get('/bk/cekNilai', 'BkController@formKelas');
    Route::get('/bk/sks/showKelasSks/{id}', 'sksController@showKelasSksid');
});

//=================route nya siswa =============================//
Route::group(['middleware' => ['absen']], function () {
    //routenya absen
    //Route::get('/siswa/absen', 'AbsenController@index');
    Route::get('/admin/absen/kelas/{id}', 'AbsenController@absen');
    Route::post('/admin/absen', 'AbsenController@store');
    Route::get('/admin/absen/rekap', 'AbsenController@rekap');
});

//================= ROUTE siswa yang ngabsen =================================//
Route::group(['middleware' => ['murid']], function () {
    Route::get('/siswa/absen', 'AbsenGurusController@index');
    Route::resource('/admin/AdminAbsenGuru', 'AbsenGurusController');

    Route::get('jurnal', 'JurnalController@index');
    Route::get('/siswa/jurnal/kelas/{id}', 'JurnalController@create');
    Route::post('/siswa/jurnal/', 'JurnalController@store');
    Route::get('/siswa/denah', 'JurnalController@show');
    Route::get('siswa/form', 'KguruController@formPass');
    Route::post('/siswa/update', 'KguruController@updatePass');
    Route::get('siswa/ps', 'profSiswa@ps');
    Route::get('siswa/hi', 'AbsenController@hi');

    Route::get('siswa/nis', 'profSiswa@nis');
    Route::get('siswa/rombel', 'profSiswa@rombel');
    Route::put('siswa/nis', 'profSiswa@upnis');
    Route::get('kelulusan', 'SibaController@kelulusan');
    Route::get('/siswa/kelulusan1', 'SibaController@kelulusan1');
    Route::get('updateP', 'SibaController@updateP');

    //==================== sks =====================================//
    Route::get('/murid/ukbm', 'sksController@materi1');
    Route::get('/murid/ukbm1', 'sksController@fileLanjutan');
    Route::get('/murid/nilai', 'sksController@showNilai');
    Route::get('murid/nilaiProfile', 'sksController@nilaiProfile');
    Route::post('murid/fixCetak', 'sksController@fixCetak');
    Route::get('murid/downloadRapor', 'sksController@downloadRapor');
    // Route::get('siswa/eNis', 'profSiswa@eNis');
    Route::put('siswa/UpNis', 'profSiswa@UpNis1');
    //
    Route::get('siswa/DelNilai', 'adminController@DelNilai');
    Route::get('siswa/Dnilai/{id}', 'adminController@Dnilai');
    Route::get('siswa/materi', 'siswaController@materi');
    Route::get('siswa/mm/{id}', 'siswaController@mm');
    Route::post('siswa/download', 'siswaController@download');


    /* role siswa yang sudah lulus*/
    Route::get('siswa/lulus', 'siswaController@lulus');
});

Route::group(['middleware' => ['tu']], function () {
    Route::get('/tu/index', 'TuController@index');
    Route::get('/tu/sm', 'TuController@sm');
    Route::get('/tu/sk', 'TuController@sk');
    Route::get('tu/file/{id}', 'TuController@view');
    Route::get('tu/api/kode', 'ApiTu@GetKode');
    Route::get('tu/api/shi', 'ApiTu@shi');
    Route::post('tu/api/save', 'ApiTu@saveKode');
    Route::delete('tu/api/delete/{id}', 'ApiTu@delete');
    Route::put('tu/api/update/{id}', 'ApiTu@update');
    Route::get('tu/api/kat', 'ApiTu@kategori');
    Route::post('tu/api/saveSurat', 'ApiTu@saveSurat');
    Route::get('tu/RAbsen', 'TuController@report');
    Route::get('tu/del/{id}', 'TuController@delSurat');
    Route::get('tu/delpot/{id}', 'TuController@delpot');

    /** SPP */
    Route::get('tu/setSpp', 'TuController@setSpp');
    Route::post('tu/saveSet', 'TuController@saveSet');
    Route::post('tu/saveNominal', 'TuController@saveNominal');
    Route::post('tu/saveNominal', 'TuController@saveNominal');
    Route::get('tu/del/nom/{id}', 'TuController@delnom');
    Route::get('tu/del/persen/{id}', 'TuController@delPersen');
    Route::post('tu/siswaPotongan', 'TuController@siswaPotongan');
    Route::get('tu/bayar', 'TuController@bayar');
    Route::post('tu/plhKls', 'TuController@plhKls');
});

/*============= siba =======================*/
Route::group(['middleware' => ['siba']], function () {
    Route::get('/sibA/index', 'Siba1Controller@formKosong');
    Route::post('/sibA/bio', 'Siba1Controller@formBiodata');
    Route::get('/sibA/tampil', 'Siba1Controller@tampilview');
    Route::post('/sibA/bio1', 'Siba1Controller@updateForm');
});

//ini di luar dari middleware

// Route::get('/home', 'HomeController@index');
Route::get('/micro', 'MicroController@index');

/*===============================    SISWA BARU =======================*/
Route::get('/siba', 'SibaController@index');
Route::post('/siba/register', 'SibaController@register');
Route::get('/siba/cek', 'SibaController@cek');
Route::get('/sibA/fw', 'SibaController@fw');
// Route::get('/sibA/angket', 'SibaController@angket');
// Route::get('/siswa/angketPtm', 'SibaController@angketPtm');
Route::post('/siswa/saveAngketPtm', 'SibaController@saveAngketPtm');
Route::post('sibA/simNilai', 'SibaController@simNilai');
Route::get('sibA/editN', 'SibaController@editN');
Route::put('sibA/UpNi', 'SibaController@UpNi');
Route::get('sibA/InFile', 'SibaController@InFile');
Route::post('sibA/SimFile', 'SibaController@SimFile');
Route::get('sibA/delfile/{id}', 'SibaController@delfile');


/*===============================  ppdb  ===============================*/
Route::get('ppdb2020', 'ppdbController@index');
Route::get('ppdb2020/formulir', 'ppdbController@formulir');

Route::group(['middleware' => ['pengumuman']], function () {
    Route::get('ppdb2020/peng', 'ppdbController@peng');
    Route::post('ppdb2020/simpBerk', 'ppdbController@simpBerk');
    Route::get('ppdb2020/del/{id}', 'ppdbController@del');
});

/*============== disable register ===================*/
Auth::routes(['verify' => true, 'register' => false]);

Route::get('cekSort', 'TestController@ceksort');
