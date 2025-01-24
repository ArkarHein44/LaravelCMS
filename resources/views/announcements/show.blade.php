@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">        
            <div class="col-md-12">
				<a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0">back</a>
                <a href="{{route('announcements.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div> 

            <hr />

            <div class="col-md-12">
                <div class="row">                    
                    
                    <div class="col-md-4 col-lg-3 mb-2">
						<h6 class="text-primary">Info</h6>
                        <div class="card rounded-0 border-0 shadow">
                            <div class="card-body">
                                
								<div class="d-flex flex-column align-items-center mb-3">									
									<div class="h6 mb-1">{{$announcement->title}}</div>
									<div class="text-muted">
										{{-- <span class="">{{$announcement['stage']['name']}}</span> --}}
									</div>
								</div>

								<div class="mb-3">

									<div class="row g-0 mb-2">

										<div class="col-auto">
											<i class="fas fa-user"></i>
										</div>

										{{-- <div class="col ps-3">
											<div class="row">
												<div class="col">
													<h6 class="">Tag</h6>
												</div>
												<div class="col-auto">
													

													@foreach($announcement->tagpersons($announcement->tag) as $id=>$name)
														<a href="javascript:void(0);">{{$name}}</a>
													@endforeach
													
												</div>
											</div>
										</div> --}}

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
									<h1 class="acctitle">E Mail</h1>
									<div class="acccontent">										
										<div class="col-md-12 py-3">
											<form action="" class="" method="POST">
												@csrf
												<div class="row">

													<div class="col-md-6 form-group mb-3">
														<input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 ronded-0" placeholder="To:" value="" readonly/>
													</div>

													<div class="col-md-6 form-group mb-3">
														<input type="text" name="cmpsubject" id="cmpsubject" class="form-control form-control-sm border-0 ronded-0" placeholder="Subject:" value="" />
													</div>

													<div class="col-md-6 form-group mb-3">
														<textarea name="cmpcontent" id="cmpsubject" class="form-control form-control-sm border-0 ronded-0" rows="3" placeholder="Your message here..." style="resize: none"></textarea>
													</div>

													<div class="col d-flex justify-content-end align-items-end">
														<button type="submit" class="btn btn-secondary btn-sm rounded-0" >Send</button>
													</div>
												</div>
											</form>
										</div>
									</div>			
								</div>
							</div>
						</div>

						<h6 class="">Class</h6>
						<div class="card border-0 rounded-0 shadow mb-4">
							<div class="card-body d-flex flex-wrap gap-3">						

							</div>
						</div>

						<h6 class="px-2">Additional Info</h6>
                    	<div class="card border-0 rounded-0 shadow mb-4 p-3">

							<ul class="nav">
								<li class="nav-item">
									<button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'contenttab')">Content</button>
									
								</li>
							</ul>

							<div class="tab-content">

								<div id="contenttab" class="tab-panel">

									<p>{!! $announcement->content !!}</p>

									@if(!empty($announcement->image))
											
												<a href="{{asset($announcement->image)}}" data-lightbox="image" data-title="{{$announcement->title}}">
													<img src="{{asset($announcement->image)}}" alt="{{$announcement->id}}" class="img-thumbnail" width="100" height="100" />
												</a>
								                                     
										@else
											<span>No Files</span>
									@endif
									
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

	<link rel="stylesheet" href="{{asset('assets/libs/lightbox2-dev/dist/css/lightbox.min.css')}}">

	<style type="text/css">
	/* Start Accordion */
		.accordion{
			width: 100%;
		}

		.acctitle{
			background-color: #777;
			color: #fff;
			font-size: 14px;
			user-select: none;

			padding: 15px;
			margin: 0;

			cursor: pointer;

			position: relative;

			transition: background-color 0.3s;
		}

		.acctitle:hover,.active{
			background-color: steelblue;
		}

		.acccontent{
			height: 0;
			background-color: #f4f4f4;
			text-indent: 50px;
			text-align: justify;
			font-size: 14px; 

			padding: 0 20px;

			overflow: hidden;

			transition: height .3s ease-in-out;
		}
	/* End Accordion */


	/* Start Tab  */
	.nav{
	display: flex;
	
	padding: 0;
	margin: 0;
	}

	.nav .nav-item{
		list-style-type: none;
	}

	.nav .tablinks{
		font-size: 16px;
		border: none;
		padding: 15px 20px;
		cursor: pointer;

	}

	.nav .tablinks:hover{
		background-color: #f3f3f3;
	}

	.nav .tablinks.active{
		color: white;
	}

	.tab-pane{
		/* border: 1px solid #ccc; */
		/* border-top: 0; */

		padding: 5px 15px;

		display: none;
	}
	/* End Tab  */
	</style>

@endsection


@section('scripts')
<script src="{{asset('assets/libs/lightbox2-dev/dist/js/lightbox.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
	// Accordion
	var getacctitles = document.getElementsByClassName("acctitle");
	// console.log(getacctitles); //HTML Collection
	var getacccontents = document.querySelectorAll(".acccontent");
	// console.log(getacccontent); //NODE List


	for(var x = 0; x < getacctitles.length; x++){
	// console.log(x);

	getacctitles[x].addEventListener("click",function(e){
	// console.log(e.target);
	// console.log(this);

	this.classList.toggle("active");
	var getcontent = this.nextElementSibling;
	// console.log(getcontent);

	if(getcontent.style.height){
	getcontent.style.height=null; //beaware can't set to 0
	}else{
	// console.log(getcontent.scrollHeight);
	getcontent.style.height=getcontent.scrollHeight + "px";
	}	

	});

	if(getacctitles[x].classList.contains("active")){
	getacccontents[x].style.height = getacccontents[x].scrollHeight+"px";
	}

	}
	// End Accordion

	// Start Tab 

	let gettatlinks = document.getElementsByClassName('tablinks'),
            gettabpanels = document.getElementsByClassName('tab-panel');

            let tabpanels = Array.from (gettabpanels);
            
            function gettab(evn,link){

                // Remove All active 

                for(let x=0; x < gettatlinks.length ; x++){

                    // console.log(x); // 0 to 3

                    gettatlinks[x].className = gettatlinks[x].className.replace(' active','');

                }

                // Add sigle active
                evn.target.classList.add('active');

                
                // Hide All Panel 
                tabpanels.forEach(function(tabpanel){
                    tabpanel.style.display = "none";
                });

                // Show single Panel
                document.getElementById(link).style.display = "block";

            }

            document.getElementById('autoclick').click();
        // End Tab


        lightbox.option({
            'resizeDuration': 100,
            'wrapAround': true
        });

    </script>
@endsection
        