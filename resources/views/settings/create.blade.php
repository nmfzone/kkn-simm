@extends('adminlte::layouts.app')

@section('stylesheets')
  <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
	{{ trans('message.settings.manage') }}
@endsection

@section('contentheader_title')
  {{ trans('message.settings.manage') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
      <div class="col-md-12 no-padding">
        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pendidikan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('education.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('education_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="education_name" value="{{ old('education_name') }}">

                    @if ($errors->has('education_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('education_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Pendidikan</h4>

              <table class="table table-bordered table-hover the-tables" id="education-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($educationAll->isEmpty())
                    <td colspan="3" class="text-center">Daftar Pendidikan masih kosong</td>
                  @else
                    @foreach($educationAll as $education)
                      <tr>
                        <td>{{ $education->name }}</td>
                        <td>
                          <a href="{{ route('education.edit', $education) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('education.destroy', $education) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $educationAll->links() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pekerjaan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('jobs.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('job_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="job_name" value="{{ old('job_name') }}">

                    @if ($errors->has('job_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Pekerjaan</h4>

              <table class="table table-bordered table-hover the-tables" id="jobs-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($jobs->isEmpty())
                    <td colspan="3" class="text-center">Daftar Pekerjaan masih kosong</td>
                  @else
                    @foreach($jobs as $job)
                      <tr>
                        <td>{{ $job->name }}</td>
                        <td>
                          <a href="{{ route('jobs.edit', $job) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('jobs.destroy', $job) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $jobs->links() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Provinsi</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('provinces.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('province_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="province_name" value="{{ old('province_name') }}">

                    @if ($errors->has('province_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('province_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Provinsi</h4>

              <table class="table table-bordered table-hover the-tables" id="provinces-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($provinces->isEmpty())
                    <td colspan="3" class="text-center">Daftar Provinsi masih kosong</td>
                  @else
                    @foreach($provinces as $province)
                      <tr>
                        <td>{{ $province->name }}</td>
                        <td>
                          <a href="{{ route('provinces.edit', $province) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('provinces.destroy', $province) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $provinces->links() }}
              </div>
            </div>
          </div>
        </div>
			</div>
      <div class="col-md-12 no-padding">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Disabilitas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('disabilities.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('disability_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="disability_name" value="{{ old('disability_name') }}">

                    @if ($errors->has('disability_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('disability_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Disabilitas</h4>

              <table class="table table-bordered table-hover the-tables" id="disabilities-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($disabilities->isEmpty())
                    <td colspan="3" class="text-center">Daftar Disabilitas masih kosong</td>
                  @else
                    @foreach($disabilities as $disability)
                      <tr>
                        <td>{{ $disability->name }}</td>
                        <td>
                          <a href="{{ route('disabilities.edit', $disability) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('disabilities.destroy', $disability) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $disabilities->links() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Kabupaten</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('districts.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('province_id') ? ' has-error' : '' }}">
                  <label for="name">Provinsi</label>
                  <div class="form-group">
                    <select class="form-control search-province" name="province_id">
                      @foreach(App\Province::all() as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('province_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('province_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('district_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="district_name" value="{{ old('district_name') }}">

                    @if ($errors->has('district_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('district_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Kabupaten</h4>

              <table class="table table-bordered table-hover the-tables" id="districts-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Provinsi</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($districts->isEmpty())
                    <td colspan="3" class="text-center">Daftar Kabupaten masih kosong</td>
                  @else
                    @foreach($districts as $district)
                      <tr>
                        <td>{{ $district->name }}</td>
                        <td>{{ $district->province->name }}</td>
                        <td>
                          <a href="{{ route('districts.edit', $district) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('districts.destroy', $district) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $districts->links() }}
              </div>
            </div>
          </div>
        </div>
			</div>

      <div class="col-md-12 no-padding">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Kecamatan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('sub_districts.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                  <label for="name">Kabupaten</label>
                  <div class="form-group">
                    <select class="form-control search-district" name="district_id">
                      @foreach(App\District::all() as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('district_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('district_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('sub_district_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="sub_district_name" value="{{ old('sub_district_name') }}">

                    @if ($errors->has('sub_district_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sub_district_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                  <label for="name">Kodepos</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}">

                    @if ($errors->has('postal_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Kecamatan</h4>

              <table class="table table-bordered table-hover the-tables" id="sub-districts-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Kodepos</th>
                    <th>Kabupaten</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($subDistricts->isEmpty())
                    <td colspan="3" class="text-center">Daftar Kecamatan masih kosong</td>
                  @else
                    @foreach($subDistricts as $subDistrict)
                      <tr>
                        <td>{{ $subDistrict->name }}</td>
                        <td>{{ $subDistrict->postal_code }}</td>
                        <td>{{ $subDistrict->district->name }}</td>
                        <td>
                          <a href="{{ route('sub_districts.edit', $subDistrict) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('sub_districts.destroy', $subDistrict) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $subDistricts->links() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Desa</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('villages.store') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('sub_district_id') ? ' has-error' : '' }}">
                  <label for="name">Kecamatan</label>
                  <div class="form-group">
                    <select class="form-control search-sub-district" name="sub_district_id">
                      @foreach(App\SubDistrict::all() as $subDistrict)
                        <option value="{{ $subDistrict->id }}">{{ $subDistrict->name }}</option>
                      @endforeach
                    </select>

                    @if ($errors->has('sub_district_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sub_district_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('village_name') ? ' has-error' : '' }}">
                  <label for="name">Nama</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="village_name" value="{{ old('village_name') }}">

                    @if ($errors->has('village_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('village_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-info">Tambah</button>
                </div>
              </form>

              <h4>Daftar Desa</h4>

              <table class="table table-bordered table-hover the-tables" id="villages-table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th width="70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($villages->isEmpty())
                    <td colspan="3" class="text-center">Daftar Desa masih kosong</td>
                  @else
                    @foreach($villages as $village)
                      <tr>
                        <td>{{ $village->name }}</td>
                        <td>{{ $village->subDistrict->name }}</td>
                        <td>
                          <a href="{{ route('villages.edit', $village) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('villages.destroy', $village) }}" class="btn btn-xs btn-primary delete-this"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <div class="pull-right">
                {{ $villages->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>
@endsection

@section('javascripts')
  <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/select2/select2.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(function() {
      $('.search-province').select2();
      $('.search-district').select2();
      $('.search-sub-district').select2();
      // $('#education-table').DataTable({
      //   processing: true,
      //   serverSide: true,
      //   ajax: '{!! route('education.getEducation') !!}',
      //   columns: [
      //     { data: 'id', name: 'id' },
      //     { data: 'name', name: 'name' },
      //     { data: 'action', name: 'action', orderable: false, searchable: false, width: '250px' }
      //   ]
      // });
    });
  </script>
@endsection
