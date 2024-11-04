@extends('layouts.adminindex')
@section('content')
    <!-- Start Content Area -->
    <div class="container-fluid">
        <div class="col-md-12">
            <form action="{{ route('roles.store') }}" method="POST">
                {{-- {{ csrf_field() }} --}}
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-6 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-sm "
                            placeholder="Enter role Name" />
                    </div>

                    <div class="col-md-6 ">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>
                </div>
            </form>

            <hr>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk
                            Delete</a>
                    </div>

                    <div class="col-md-10">
                        <div class="row justify-content-end">
                            <div class="col-md-2 col-sm-6 form-group">
                                <div class="input-group">
                                    <input type="text" name="filtername" id="filternamename"
                                        class="form-control form-control-sm rounded-sm " placeholder="Search" />
                                    <button type="submit" id="search-btn" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>

                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>By</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($roles as $idx => $role)
                            <tr>
                                <td>select</td>
                                <td>{{ ++$idx }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->status_id }}</td>
                                <td>{{ $role['user']['name'] }}</td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>{{ $role->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0)" class="text-danger ms-2"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Content Area -->
@endsection



@section('css')
@endsection

@section('scripts')
@endsection
