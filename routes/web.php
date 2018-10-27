<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/test', function(){
//   return \Hash::make('admin');
// });
Route::group(['middleware' => ['auth']], function() {
  Route::get('/', 'PenjualanController@index');
  // Route::get('/', function () {
  //   return view('welcome');
  // });

  //konsumen
  Route::group(['prefix' => '/konsumen'], function() {
    Route::get('/', ['as' => 'konsumen', 'uses' => 'KonsumenController@index']);
    Route::get('/create', 'KonsumenController@create');
    Route::post('/create', 'KonsumenController@create');
    Route::get('/update/{id}', 'KonsumenController@update');
    Route::post('/update/{id}', 'KonsumenController@update');
  });

  //supplier
  Route::group(['prefix' => '/suplier'], function() {
    Route::get('/', ['as' => 'suplier', 'uses' => 'SupplierController@index']);
    Route::get('/create', 'SupplierController@create');
    Route::post('/create', 'SupplierController@create');
    Route::get('/update/{id}', 'SupplierController@update');
    Route::post('/update/{id}', 'SupplierController@update');
  });

  //master
  Route::group(['prefix' => '/master'], function() {
    //kategori
    Route::group(['prefix' => '/kategori'], function() {
      Route::get('/', ['as' => 'kategori', 'uses' => 'KategoriController@index']);
      Route::get('/create', 'KategoriController@create');
      Route::post('/create', 'KategoriController@create');
      Route::get('/update/{id}', 'KategoriController@update');
      Route::post('/update', 'KategoriController@update');
    });

    //Merk
    Route::group(['prefix' => '/merk'], function() {
      Route::get('/', ['as' => 'merk', 'uses' => 'MerkController@index']);
      Route::get('/create', 'MerkController@create');
      Route::post('/create', 'MerkController@create');
      Route::get('/update/{id}', 'MerkController@update');
      Route::post('/update', 'MerkController@update');
    });

    //satuan barang
    Route::group(['prefix' => '/satuan-barang'], function() {
      Route::get('/', ['as' => 'satuan-barang', 'uses' => 'SatuanBarangController@index']);
      Route::get('/create', 'SatuanBarangController@create');
      Route::post('/create', 'SatuanBarangController@create');
      Route::get('/update/{id}', 'SatuanBarangController@update');
      Route::post('/update', 'SatuanBarangController@update');
    });

    //barang
    Route::group(['prefix' => '/barang'], function() {
      Route::get('/', ['as' => 'barang', 'uses' => 'BarangController@index']);
      Route::get('/create', 'BarangController@create');
      Route::post('/create', 'BarangController@create');
      Route::get('/update/{id}', 'BarangController@update');
      Route::post('/update', 'BarangController@update');
    });
  });

  //riwayat harga barang
  Route::group(['prefix' => '/setting-harga-barang'], function() {
    Route::get('/', ['as' => 'setting-harga-barang', 'uses' => 'RiwayatHargaBarangController@index']);
    Route::get('/create', 'RiwayatHargaBarangController@create');
    Route::post('/create', 'RiwayatHargaBarangController@create');
    Route::get('/update/{id}', 'RiwayatHargaBarangController@update');
    Route::post('/update', 'RiwayatHargaBarangController@update');
  });

  //penjualan
  Route::group(['prefix' => '/penjualan'], function() {
    Route::get('/', ['as' => 'penjualan', 'uses' => 'PenjualanController@index']);
    Route::post('/', 'PenjualanController@index');
    Route::get('/getSelection', 'PenjualanController@getSelection');
    Route::get('/v2', 'PenjualanController@indexV2');
    Route::get('/create', 'PenjualanController@create');
    Route::post('/addCart', 'PenjualanController@addCart');
    Route::get('/getTotal', 'PenjualanController@getTotal');
    Route::get('/getCart', 'PenjualanController@getCart');
    Route::get('/getDataPenjualan', 'PenjualanController@getDataPenjualan');
    Route::post('/storeCart', 'PenjualanController@storeCart');
    Route::get('/removeCart', 'PenjualanController@removeCart');
    Route::get('/nota/{id}', 'PenjualanController@nota');
    Route::get('/cekharga', 'PenjualanController@cekHarga');
    Route::get('/cekcicilan', 'PenjualanController@cekCicilan');
    Route::get('/nota', function(){
      return view('penjualan.nota_penjualan');
    });
  });

  //harga khusus
  Route::group(['prefix' => '/hargaKhusus'], function() {
    Route::get('/', 'HargaKhususController@index');
    Route::get('/create', 'HargaKhususController@create');
    Route::get('/update', 'HargaKhususController@update');
    Route::post('/store', 'HargaKhususController@store');
  });

  //pengadaan
  Route::group(['prefix' => '/pengadaan'], function() {
    Route::get('/', ['as' => 'pengadaan', 'uses' => 'PengadaanController@index']);
    Route::post('/', 'PengadaanController@update');
    Route::get('/create', 'PengadaanController@create');
    Route::post('/addCart', 'PengadaanController@addCart');
    Route::get('/getCart', 'PengadaanController@getCart');
    Route::get('/getDataPengadaan', 'PengadaanController@getDataPengadaan');
    Route::post('/storeCart', 'PengadaanController@storeCart');
    Route::get('/removeCart', 'PengadaanController@removeCart');

    Route::post('/addCartKemasan', 'PengadaanController@addCartKemasan');
    Route::get('/getCartKemasan', 'PengadaanController@getCartKemasan');
    Route::get('/getDataPengadaan', 'PengadaanController@getDataPengadaan');
    Route::post('/storeCartKemasan', 'PengadaanController@storeCartKemasan');
    Route::get('/removeCartKemasan', 'PengadaanController@removeCartKemasan');

    Route::get('/nota/{id}', 'PengadaanController@nota');
  });

  //pengeluaran
  Route::group(['prefix' => '/pengeluaran'], function() {
    Route::get('/', ['as' => 'pengeluaran', 'uses' => 'PengeluaranController@index']);
    Route::get('/create', 'PengeluaranController@create');
    Route::get('/getDataPengeluaran', 'PengeluaranController@getDataPengeluaran');
    Route::post('/store', 'PengeluaranController@store');
    Route::get('/nota/{id}', 'PengeluaranController@nota');
  });

  //laporan
  Route::group(['prefix' => '/laporan'], function() {
    Route::get('/', 'LaporanController@index');
    Route::get('/getDataLaporan', 'LaporanController@getDataLaporan');
  });
});

Auth::routes();

Route::get('/home', 'LoginController@index')->name('home');
