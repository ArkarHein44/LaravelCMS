@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        
            <div class="col-md-12">
				<a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0">back</a>
                <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div> 

            <hr />

            <div class="col-md-12">
                <div class="row">
                    
                    
                    <div class="col-md-4 col-lg-3 mb-2">
						<h6 class="text-primary">Info</h6>
                        <div class="card rounded-0 border-0 shadow">

                            <div class="card-body">
                                
								<div class="d-flex flex-column align-items-center mb-3">
									
									<div class="h6 mb-1">							{{$leave->title}}</div>

									<div class="text-muted">
										<span class="">{{$leave['stage']['name']}}</span>
									</div>
								</div>

								<div class="mb-3">
									<div class="row g-0 mb-2">

										<div class="col-auto">
											<i class="fas fa-user"></i>
										</div>

										<div class="col ps-3">
											<div class="row">
												<div class="col">
													<h6 class="">Tag</h6>
												</div>
												<div class="col-auto">
													{{-- <a href="javascript:void(0);">{{$leave->maptagtonames($users)}}</a> --}}

													@foreach($leave->tagpersons($leave->tag) as $id=>$name)
														<a href="javascript:void(0);">{{$name}}</a>
													@endforeach
													
												</div>
											</div>
										</div>

									</div>
								</div>

                            </div>
                        </div>   
                    </div>

					<div class="col-md-8 col-lg-9">

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
        