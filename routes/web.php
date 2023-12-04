<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Ops\Dashboardops;
use App\Http\Controllers\Edp\BisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Edp\KotaController;
use App\Http\Controllers\Edp\PoolController;
use App\Http\Controllers\Edp\PostController;
use App\Http\Controllers\Edp\RuteController;
use App\Http\Controllers\Ops\TiketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Cso\ArmadaController;
use App\Http\Controllers\Cso\BisbookingController;
use App\Http\Controllers\Cso\BookingController;
use App\Http\Controllers\Cso\PembayaranController;
use App\Http\Controllers\Cso\TujuanController;
use App\Http\Controllers\Edp\PosisiController;
use App\Http\Controllers\Edp\CommentController;
use App\Http\Controllers\Edp\JabatanController;
use App\Http\Controllers\Edp\ProductController;
use App\Http\Controllers\Edp\UserAppController;
use App\Http\Controllers\Hrd\BiodataController;
use App\Http\Controllers\Edp\BisRekapController;
use App\Http\Controllers\Edp\TarifpnpController;
use App\Http\Controllers\Hrd\KaryawanController;
use App\Http\Controllers\Thk\BischeckController;
use App\Http\Controllers\Thk\BuscheckController;
use App\Http\Controllers\Thk\CheckbisController;
use App\Http\Controllers\Cso\PemesananController;
use App\Http\Controllers\Edp\KelurahanController;
use App\Http\Controllers\Hrd\KondekturController;
use App\Http\Controllers\Hrd\PengemudiController;
use App\Http\Controllers\Edp\PerusahaanController;
use App\Http\Controllers\Edp\PoscheckerController;
use App\Http\Controllers\Ops\PendharianController;
use App\Http\Controllers\Cso\PemesananUserController;
use App\Http\Controllers\Operasi\JadwalArmadaController;
use App\Http\Controllers\Operasi\SpjkeluarController;
use App\Http\Controllers\Operasi\SpjmasukController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::resource('booking', BookingController::class);
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');



    // Route::get('/booking/create/{id}', 'BookingController@create')->name('booking.create');


    Route::resource('pemesanan', PemesananController::class);
    Route::get('/pemesanan/{id}', 'PemesananController@show')->name('pemesanan.show');
    Route::get('create-pemesanan', [PemesananUserController::class, 'create'])->name('user.pesan.create');
    Route::post('/pemesan-user', [PemesananUserController::class, 'storeOrUpdate'])->name('pemesanan.storeOrUpdate');
    Route::get('/pemesanan-pdf', [PemesananController::class, 'pdf'])->name('pemesanan.pdf');
    Route::get('pemesanan/{id}/invoice', [PemesananController::class, 'invoicePesananPDF'])->name('pemesanan.invoice');
    Route::post('cek-stok-bis', 'StokBisController@cekStokBis')->name('cek-stok-bis');
    Route::resource('/jadwal', JadwalArmadaController::class);

    //Report PDF
    Route::get('/kelurahans/view-pdf', [KelurahanController::class, 'viewPDF'])->name('kelurahan.view-pdf');
    Route::get('/biss/view-pdf', [BisController::class, 'viewPDF'])->name('bis.view-pdf');
    Route::get('export-pdf', [BisController::class, 'exportPDF'])->name('bis.export-pdf');
    Route::get('/biss/export-pdf', 'BissController@exportPDF')->name('biss.export-pdf');
    Route::get('/biss/export-pdf/{search}', [BisController::class, 'exportPdf'])->name('biss.exportPdf');
    Route::get('/bis//exportpdf/{search}', [BisController::class, 'exportPdf'])->name('buses.exportPdf');
    Route::resource('bis-booking', BisbookingController::class);



    Route::get('/biodatas/view-pdf', [BiodataController::class, 'viewPDF'])->name('biodata.view-pdf');

    Route::get('/rutes/view-pdf', [RuteController::class, 'viewPDF'])->name('rutes.view-pdf');

    //Operasi
    Route::resource('/tikets', TiketController::class);
    Route::resource('/bisrekaps', BisRekapController::class);
});

Route::middleware([CheckRole::class.':super admin,admin'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::get('users/{name}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::resource('/userapps', UserAppController::class);
    Route::resource('/roles', RoleController::class);

    Route::resource('/kelurahans', KelurahanController::class);
    Route::resource('/kotas', KotaController::class);
    Route::resource('/perusahaans', PerusahaanController::class);
    Route::resource('/product', ProductController::class);
});

Route::middleware([CheckRole::class.':super admin,admin,edp'])->group(function () {

    Route::resource('/posisis', PosisiController::class);
    // Route::resource('/divisis', DivisiController::class);
    Route::resource('/pool', PoolController::class);
    Route::resource('/rute', RuteController::class);
    Route::resource('/biss', BisController::class);

    Route::resource('armada', ArmadaController::class);
    Route::resource('tujuan', TujuanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/pembayaran/{nomorPembayaran}', 'PembayaranController@show')->name('pembayaran.show');
    Route::get('/pembayaran-by-id/{id}', 'PembayaranController@showById')->name('pembayaran.showById');
    Route::get('/pembayaran/create/{id}', 'PembayaranController@create');
    Route::get('/getPemesanDetails/{id}', 'PembayaranController@getPemesanDetails');


    Route::resource('/poscheckers', PoscheckerController::class);
    Route::resource('/tarifpnps', TarifpnpController::class);

});

Route::middleware([CheckRole::class.':super admin,admin,owner,manager'])->group(function () {
    Route::resource('/posts', PostController::class);
    // Route::resource('armada', [ArmadaController::class]);
});

Route::middleware([CheckRole::class.':super admin,admin,owner,operasi'])->group(function () {
    Route::resource('spj-masuk', SpjmasukController::class);
    Route::resource('/dashboardops', Dashboardops::class);
    Route::resource('/tikets', TiketController::class);
    Route::resource('/pendharians', PendharianController::class);
    // Route::get('/sortir', [PendharianController::class, 'sortir'])->name('sortir');
});

Route::middleware([CheckRole::class.':super admin,admin,owner,hrd,edp'])->group(function () {
    Route::resource('/jabatans', JabatanController::class);
    Route::resource('/biodatas', BiodataController::class);
    Route::get('/biodata/search', [BiodataController::class, 'search'])->name('biodata.search');
    Route::get('/biodatas/create/{identifier}', [Hrd\BiodataController::class, 'create'])->name('biodata.create');
    Route::match(['put', 'patch'], '/biodatas/{biodata}', [BiodataController::class, 'update'])->name('biodatas.update');
    Route::get('biodatas/getname/{nik}', 'BiodataController@getname');
    Route::get('/get-kotalahir', 'BiodataController@getKotalahir');

    Route::get('/get-kelurahan-data', 'BiodataController@getKelurahanData')->name('get-kelurahan-data');

    Route::resource('karyawans', KaryawanController::class);
    Route::get('/searchNik', [KaryawanController::class, 'searchNik'])->name('searchNik');

    Route::resource('pengemudi', PengemudiController::class);
    Route::get('/pengemudi/{id}', 'PengemudiController@show')->name('pengemudi.show');
    Route::get('/search-nik', [PengemudiController::class, 'searchNik'])->name('search-nik');
    Route::get('biodata/{biodataId}/pengemudi', [PengemudiController::class, 'index'])->name('biodata.pengemudi.index');

    Route::resource('kondektur', KondekturController::class);
    Route::get('/kondektur/{id}', 'KondekturController@show')->name('kondektur.show');

    });

    Route::middleware([CheckRole::class.':super admin,admin,owner,tehnik,operasi,edp'])->group(function () {
        Route::resource('spj-keluar', SpjkeluarController::class);
        Route::get('spj-keluar-print/{nomorspj}', 'SpjkeluarController@viewPDF')->name('spj-keluar.print');
        Route::resource('checkbis', CheckbisController ::class);
        Route::resource('bischecks', BischeckController ::class);
        Route::resource('buschecks', BuscheckController ::class);
        Route::post('/check-password', [BuscheckController::class, 'checkPassword'])->name('check-password');
        Route::get('/get-namauser', 'BuscheckController@getNamaUser');


    });

// Route::middleware(['auth'])->group(function () {
//     Route::middleware(['role:admin'])->group(function () {
//         Route::resource('/users', UserController::class);
//         Route::resource('/roles', RoleController::class);
//     });
//     Route::middleware(['role:operasi'])->group(function () {
//         // Route::resource('/tikets', TiketController::class);
//     });

// });

// Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
//     // Users
//     Route::resource('/users', UserController::class);
//     Route::resource('/roles', RoleController::class);

// });

require __DIR__.'/auth.php';
