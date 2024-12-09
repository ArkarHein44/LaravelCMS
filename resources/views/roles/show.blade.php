@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        
            <div class="col-md-12">
                <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div> 

            <hr />

            <div class="col-md-12">
                <div class="row">
                    
                    
                    <div class="col-md-10">
                        <div class="card rounded-0">

                            <div class="card-body">
                                <h6 class="card-title">{{$role->name}} | <span class="text-muted">{{$role->status['name']}}</span></h6>

                                <ul class="list-group text-center">
                                    <li class="list-group-item">
                                        <img src="{{asset($role->image)}}" alt="{{$role->slug}}" width="200" class="">
                                    </li>
                                </ul>

                                <div class="row">
                                    <div class="col-sm-6 text-muted" style="font-size:12px">
                                        <i class="fas fa-user fa-sm"></i>{{$role['user']['name']}}
                                    </div>

                                    <div class="col-sm-6 text-muted" style="font-size:12px">
                                        <i class="fas fa-calendar-alt fa-sm"></i>{{date('d M Y h:i:s A',strtotime($role->created_at))}}
                                        <br/>
                                        <i class="fas fa-edit fa-sm"></i>{{date('d M Y h:i:s A',strtotime($role->updated_at))}}
                                    </div>
                                </div>

                            </div>
                        </div>   
                    </div>

                </div>
            </div>

    </div>
    {{-- end Page Content Area  --}}

@endsection

@section('css')

@endsection


@section('scripts')

    <script type="text/javascript">

    </script>
@endsection
        