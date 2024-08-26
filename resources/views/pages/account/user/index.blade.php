@extends('pages.layouts.main')

@section('title', 'User')

@section('component-css')
    <link href="{{ dynamic_asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ dynamic_asset('template') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ dynamic_asset('template') }}/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="{{ dynamic_asset('template') }}/build/css/custom.min.css" rel="stylesheet">

    <style>
        .invalid-feedback {
            color: #a94442;
            font-size: 10px;
        }

        .is-invalid {
            border: 1px solid #a94442 !important;
        }
    </style>
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
                    <div class="x_title">
                        <h2>
                            Data @yield('title')
                        </h2>
                        <div class="row">
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                data-target=".bs-example-modal-lg">
                                <i class="fa fa-plus"></i> Tambah
                                {{ $detailMembership['total_user'] }} /
                                {{ $detailMembership['limit_user'] }}


                            </button>
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                data-target=".bs-example-modal-xl">
                                <i class="fa fa-plus"></i> Upload Excel


                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if ($detailMembership['total_user'] > $detailMembership['limit_user'])
                        <p>
                            Silahkan non-aktifkan user anda, karena telah mencapai limit. Agar Alert button dapat digunakan
                        </p>
                    @endif
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Nomor HP</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomer = 0;
                                @endphp
                                @if (count($user) == 0)
                                    <div>
                                        Kosong
                                    </div>
                                @else
                                    @foreach ($user as $item)
                                        <tr>
                                            <td class="text-center">{{ ++$nomer }}.</td>
                                            <td>{{ $item['detail']['nama'] }}</td>
                                            <td>{{ $item['detail']['email'] }}</td>
                                            <td class="text-center">
                                                {{ $item['detail']['country_code'] }}{{ $item['detail']['phone_number'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ empty($item['detail']['username']) ? '-' : $item['detail']['username'] }}
                                            </td>
                                            <td class="text-center">
                                                @if ($detailMembership['total_user'] == $detailMembership['limit_user'])
                                                    @if ($item['detail']['account_status_id'] == 'active')
                                                        <div class="custom-control custom-switch">
                                                            <input
                                                                {{ $item['detail']['account_status_id'] == 'active' ? 'checked' : '' }}
                                                                type="checkbox" class="custom-control-input js-switch"
                                                                id="customSwitch{{ $item['detail']['id_user_organization'] }}"
                                                                data-id="{{ $item['detail']['id_user_organization'] }}">
                                                            <label class="custom-control-label text-uppercase"
                                                                for="customSwitch{{ $item['detail']['id_user_organization'] }}">
                                                                {{ $item['detail']['account_status_id'] }}
                                                            </label>
                                                        </div>
                                                    @else
                                                        <span class="fw-bold">
                                                            Kuota Sudah Terpenuhi
                                                        </span>
                                                    @endif
                                                @else
                                                    <div class="custom-control custom-switch">
                                                        <input
                                                            {{ $item['detail']['account_status_id'] == 'active' ? 'checked' : '' }}
                                                            type="checkbox" class="custom-control-input js-switch"
                                                            id="customSwitch{{ $item['detail']['id_user_organization'] }}"
                                                            data-id="{{ $item['detail']['id_user_organization'] }}">
                                                        <label class="custom-control-label text-uppercase"
                                                            for="customSwitch{{ $item['detail']['id_user_organization'] }}">
                                                            {{ $item['detail']['account_status_id'] }}
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('pages.accounts.user.show', ['idUser' => $item['detail']['username']]) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-search"></i> Detail
                                                </a>
                                                <form
                                                    action="{{ route('pages.accounts.user.destroy', ['idUser' => $item['detail']['id_user_organization']]) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Yakin ? Ingin Menghapus Data Ini?')"
                                                        type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i> Tambah Data
                    </h4>
                </div>
                <form
                    action="{{ route('pages.accounts.user.store', ['member_account_code' => session('data.member_account_code')]) }}"
                    method="POST" id="form-user">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label"> Nama </label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan Nama" value="{{ old('nama') }}">
                                </div>

                                <div class="form-group">
                                    <label for="country_code" class="form-label"> Kode Negara </label>
                                    <input type="text" class="form-control" name="country_code" id="country_code"
                                        placeholder="Masukkan Kode Negara">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label"> Email </label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Masukkan Email">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number" class="form-label"> Nomor HP </label>
                                    <input type="number" class="form-control" name="phone_number" id="phone_number"
                                        placeholder="Masukkan Nomor HP" value="{{ old('phone_number') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i> Tambah User Menggunakan Excel
                    </h4>
                </div>
                <form
                    action="{{ route('pages.accounts.user.storeExcel', ['member_account_code' => session('data.member_account_code')]) }}"
                    method="POST" enctype="multipart/form-data" id="form-excel">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file" class="form-label"> Upload File </label>
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('pages.accounts.user.example-format') }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-download"></i> Download Contoh Format
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('component-js')
    <script src="{{ dynamic_asset('template') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ dynamic_asset('template') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ dynamic_asset('template') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js">
    </script>
    <script src="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ dynamic_asset('template') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{ dynamic_asset('template') }}/vendors/switchery/dist/switchery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateStatus(username) {
            $.ajax({
                url: "{{ url('/pages/account/user') }}" + "/" + username,
                type: "PUT",
                success: function(response) {
                    if (response.status == true) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }

                    window.location.reload()
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let checkboxes = document.querySelectorAll(".js-switch");

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    let checked = checkbox.checked;
                    let idUser = checkbox.getAttribute('data-id');

                    $.ajax({
                        url: "{{ url('/pages/account/user') }}" + "/" + idUser +
                            "/change-status",
                        type: "POST",
                        data: {
                            checked: checked
                        },
                        success: function(response) {
                            if (response.status == true) {
                                alert(response.message);

                                window.location.reload();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });
        });

        $(document).ready(function() {
            $("#form-user").validate({
                rules: {
                    nama: {
                        required: true
                    },
                    country_code: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    phone_number: {
                        required: true
                    }
                },
                messages: {
                    nama: {
                        required: "Nama wajib diisi.",
                    },
                    country_code: {
                        required: "Kode Negara wajib diisi."
                    },
                    email: {
                        required: "Email wajib diisi"
                    },
                    phone_number: {
                        required: "Nomor HP wajib diisi"
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });

            $("#form-excel").validate({
                rules: {
                    file: {
                        required: true
                    },
                },
                messages: {
                    file: {
                        required: "File wajib diisi.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        })
    </script>
@endsection
