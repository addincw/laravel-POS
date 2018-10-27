@extends('templates/index')
@section('judul-page')
Laporan Penjualan
@endsection

@section('judul')
<i class="fa fa-note"></i>
Laporan Penjualan
@endsection

@section('keterangan-halaman')
Laporan penjualan dapat di filter berdasarkan range tanggal tertentu, defaultnya menampilkan penjualan dari awal hingga saat ini.
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="134">0</span>
                </div>
                <div class="desc"> Member </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    Rp. <span data-counter="counterup" data-value="12.500.000">0</span></div>
                <div class="desc"> Total Penjualan </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549">0</span>
                </div>
                <div class="desc"> Transaksi </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number"> +
                    <span data-counter="counterup" data-value="89"></span>% </div>
                <div class="desc"> Brand Popularity </div>
            </div>
        </a>
    </div> -->
</div>
<div class="row" style="margin-top: 20px">
  <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light bordered">
          <div class="portlet-title">
              <div class="caption">
                  <i class="icon-cursor font-dark hide"></i>
                  <span class="caption-subject font-dark bold uppercase">Kategori Terlaris</span>
              </div>
              <div class="actions">
                  <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                      <i class="fa fa-repeat"></i> Reload </a>
              </div>
          </div>
          <div class="portlet-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="easy-pie-chart">
                          <div class="number transactions" data-percent="55">
                              <span>+55</span>% </div>
                          <a class="title" href="javascript:;"> Minuman
                              <i class="icon-arrow-right"></i>
                          </a>
                      </div>
                  </div>
                  <div class="margin-bottom-10 visible-sm"> </div>
                  <div class="col-md-4">
                      <div class="easy-pie-chart">
                          <div class="number visits" data-percent="85">
                              <span>+85</span>% </div>
                          <a class="title" href="javascript:;"> Makanan Ringan
                              <i class="icon-arrow-right"></i>
                          </a>
                      </div>
                  </div>
                  <div class="margin-bottom-10 visible-sm"> </div>
                  <div class="col-md-4">
                      <div class="easy-pie-chart">
                          <div class="number bounce" data-percent="46">
                              <span>-46</span>% </div>
                          <a class="title" href="javascript:;"> Peralatan Mandi
                              <i class="icon-arrow-right"></i>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-6 col-xs-12 col-sm-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-red-sunglo hide"></i>
                <span class="caption-subject font-dark bold uppercase">Penjualan</span>
                <span class="caption-helper">Tiap bulan..</span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a href="" class="btn dark btn-outline btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter Range
                        <span class="fa fa-angle-down"> </span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;"> Q1 2014
                                <span class="label label-sm label-default"> past </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Q2 2014
                                <span class="label label-sm label-default"> past </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:;"> Q3 2014
                                <span class="label label-sm label-success"> current </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Q4 2014
                                <span class="label label-sm label-warning"> upcoming </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div id="site_activities_loading">
                <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
            <div id="site_activities_content" class="display-none">
                <div id="site_activities" style="height: 228px;"> </div>
            </div>
            <div style="margin: 20px 0 10px 30px">
                <div class="row">
                    <!-- <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                        <span class="label label-sm label-info"> Tax: </span>
                        <h3>$134,900</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                        <span class="label label-sm label-danger"> Shipment: </span>
                        <h3>$1,134</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                        <span class="label label-sm label-warning"> Orders: </span>
                        <h3>235090</h3>
                    </div> -->
                    <div class="col-md-9 col-sm-9 col-xs-6 text-stat">
                      <!-- <span class="label label-sm label-success"> Revenue: </span> -->
                      <h3>Total Penjualan</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                      <span class="label label-sm label-success"> Sebesar : </span>
                      <h3>Rp. 12.500.000</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PORTLET-->
</div>
</div>
@endsection

@section('script')
<script src="{{ url('style/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
@endsection
