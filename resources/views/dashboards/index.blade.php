@extends('layouts.adminindex')

@section('content')
<!-- Start Page Content Area  -->
<div class="container-fluid">
        <div class="col-md-12">

            <form action="{{route('statuses.store')}}" method="POST">
                <!-- {{csrf_field()}} -->
                @csrf


                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Status " />
                    </div>

                    <div class="col-md-6 form-group">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>
                </div>
            </form>

            <hr/>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." />
                                <button type="submit" id="search-btn" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-12"> 
                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectedalls" class="form-check-input selectalls" />
                            <th>No</th>
                            <th>Name</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $idx=>$status)
                            <tr>
                                <td>select</td>
                                <td>{{++$idx}}</td>
                                <td>{{$status->name}}</td>
                                <td>{{$status->user_id}}</td>
                                <td>{{$status->cerated_at}}</td>
                                <td>{{$status->updated_at}}</td>
                                
                                <td>
                                    <a href="javascript:void(0)" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0)" class="text-danger ms-2"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- End Page Content Area  -->
@endsection
       
@section('css')
@endsection

@section('scripts')
@endsection