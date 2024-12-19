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
						<h6 class="">Compose</h6>

						<div class="card border-0 rounded-0 shadow mb-4">
							<div class="card-body">
								<div class="accordion">
		
									<h1 class="acctitle active"><i class="fas fa-hand-point-right"></i> Why are you learning JavaScript?</h1>
									<div class="acccontent">
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
        