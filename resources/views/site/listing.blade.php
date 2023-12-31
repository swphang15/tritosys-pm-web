@extends('layout.app')

@section('customstyle')
@stop

@section('content')

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="mb-0">Sites</h5>
                            <p class="text-sm mb-0">
                                Table list of sites.
                            </p>
                        </div>
                        <div class="col-sm-6" style="text-align:right;">
                            <a href="{{ url('sites/add') }}" role="button" class="btn bg-gradient-success">+ Add
                                Site</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Person In Charge</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $site)
                            <tr>
                                <td class="text-sm font-weight-normal">
                                    <a class="ref-link" href="{{url('sites')}}/{{$site->id}}">{{$site->site_id}}</a>
                                </td>
                                <td class="text-sm font-weight-normal">{{$site->name}}</td>
                                <td class="text-sm font-weight-normal">{{$site->person_in_charge}}</td>
                                <td class="text-sm font-weight-normal">{{$site->address}}</td>
                                <td class="text-sm">
                                    <a href="{{url('sites')}}/{{$site->id}}" data-bs-toggle="tooltip" data-bs-original-title="More">
                                        <i class="fas fa-eye text-info" aria-hidden="true"></i>
                                    </a>
                                    <a data-route="{{url('sites')}}/{{$site->id}}" onclick="removeData(this)" data-csrf="{{ csrf_token() }}" class="ms-3" data-bs-toggle="tooltip">
                                        <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagespecificscripts')
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endsection
