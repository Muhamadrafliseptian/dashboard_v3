@extends('pages.layouts.main')

@section('title', 'Riwayat Aktifitas')

@section("component-css")
<link href="{{ dynamic_asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content-page')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    @yield('title')
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        @if (session('success'))
            <div class="alert alert-success text-uppercase">
                <strong>Berhasil</strong>, {!! session('success') !!}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-uppercase">
                <strong>Gagal</strong>, {!! session('error') !!}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    {{-- <div class="x_title">
                        <h2>
                            Data @yield('title')
                        </h2>
                        <div class="clearfix"></div>
                    </div> --}}
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Nama Responder</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php
                                                $nomerOrganisasi = 0;
                                            @endphp
                                @foreach ($array_filter_umum as $item)
                                    <tr>
                                        <td>{{ ++$nomerOrganisasi }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>{{ $item['keterangan'] }}</td>
                                        <td>{{ $item['nama_responder'] }}</td>
                                        <td>{{ $item['timestamp'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("component-js")
<script src="{{ dynamic_asset('template') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ dynamic_asset('template') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
@endsection
