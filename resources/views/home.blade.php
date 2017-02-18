@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('message.home') }}
@endsection

@section('stylesheets')
  <link rel="stylesheet" href="{{ url('plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/morris/morris.css') }}">
@endsection

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('family_cards.index') }}">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Keluarga</span>
              <span class="info-box-number">
                {{ Auth::user()->isAn('Administrator')
                  ? App\FamilyCard::count()
                  : App\FamilyCard::RW(explode(' ', auth()->user()->position)[2])->count() }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('residents.index') }}">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Jiwa</span>
              <span class="info-box-number">
                {{ Auth::user()->isAn('Administrator')
                  ? App\Resident::count()
                  : App\Resident::RW(explode(' ', auth()->user()->position)[2])->count() }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('residents.men_lists') }}" id="ml">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-male"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Pria</span>
              <span class="info-box-number">
                {{ Auth::user()->isAn('Administrator')
                  ? App\Resident::men()->count()
                  : App\Resident::RW(explode(' ', auth()->user()->position)[2])->men()->count() }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('residents.women_lists') }}" id="fm">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-female"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Wanita</span>
              <span class="info-box-number">
                {{ Auth::user()->isAn('Administrator')
                  ? App\Resident::women()->count()
                  : App\Resident::RW(explode(' ', auth()->user()->position)[2])->women()->count() }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Grafik Penduduk</h3>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="residents-chart" style="height: 375px; position: relative;"></div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        @php($colors = ['bg-aqua', 'bg-purple', 'bg-green'])
        @foreach (App\Setting::getKadus() as $index => $value)
          <div class="col-md-4">
            <div class="small-box{{ ' ' . $colors[$index] }}">
              <div class="inner">
                <h3>{{ App\Resident::kadus($value)->count() }}</h3>
                <p>{{ $value }}</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{ route('family_cards.showKadus', $value) }}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- /.col -->
        @endforeach
    </div>

    @if(Auth::user()->isAn('Administrator'))
      <div class="row">
        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pendidikan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover the-tables" id="education-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  @if($educationAll->isEmpty())
                    <td colspan="3" class="text-center">Daftar Pendidikan masih kosong</td>
                  @else
                    @foreach($educationAll as $education)
                      <tr>
                        <td><a href="{{ route('residents.showEducationData', $education) }}">{{ $education->name }}</a></td>
                        <td>{{ $education->residentsTotal }}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $educationAll->links() }}
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-4">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pekerjaan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover the-tables" id="job-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  @if($jobs->isEmpty())
                    <td colspan="3" class="text-center">Daftar Pekerjaan masih kosong</td>
                  @else
                    @foreach($jobs as $job)
                      <tr>
                        <td><a href="{{ route('residents.showJobData', $job) }}">{{ $job->name }}</a></td>
                        <td>{{ $job->residentsTotal }}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $jobs->links() }}
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-4">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Disabilitas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover the-tables" id="disability-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  @if($disabilities->isEmpty())
                    <td colspan="3" class="text-center">Daftar Disabilitas masih kosong</td>
                  @else
                    @foreach($disabilities as $disability)
                      <tr>
                        <td><a href="{{ route('residents.showDisabilityData', $disability) }}">{{ $disability->name }}</a></td>
                        <td>{{ $disability->residentsTotal }}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $disabilities->links() }}
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    @endif
  </div>
@endsection

@section('javascripts')
  <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="{{ url('plugins/morris/morris.min.js') }}"></script>
  <script src="{{ url('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ url('plugins/knob/jquery.knob.js') }}"></script>
  <script src="{{ url('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ url('plugins/fastclick/fastclick.min.js') }}"></script>
  <script>
    $('.example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "pageLength" : 10
    });

    $('.KartuKeluarga').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "pageLength" : 15
    });

    var donut = new Morris.Donut({
      element: 'residents-chart',
      resize: true,
      colors: ["#f39c12", "#00a65a", "#dd4b39"],
      data: [
        @foreach (App\Setting::getPartition(auth()->user()->position)->all() as $partition)
          {!! '{label: "' . $partition[0] . '", value: ' . $partition[1]->count() . '},' !!}
        @endforeach
      ],
      hideHover: 'auto'
    }).on('click', function(i, row) {
      @foreach (App\Setting::getPartition(auth()->user()->position)->all() as $index => $partition)
        {!! 'if (i == ' . $index . ') {' .
          'window.location = "' . route('residents.show_partition', $index+1) . '";' .
        '}' !!}
      @endforeach
    });
  </script>
@endsection
