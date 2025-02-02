@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">        
            <div class="col-md-12">
				<a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0">back</a>
                <a href="{{route('contacts.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div> 

            <hr />

            <div class="d-flex justify-content-center align-items-center p-4">
                <div class="row bg-info-subtle ">
					<div class="col-md-12 bg-success border border-secondary d-flex justify-content-start align-items-center mb-1">
						<p class="fs-3 text-white font-info fw-bolder text-uppercase p-0 m-0">{{$contact->firstname}} {{$contact->lastname}}</p>																	
					</div>					

					<div class="col-md-12 fs-6 text-primary mb-1 py-1 px-4">
						<strong class="">Birthday : </strong><span class=""> {{$contact->birthday}}</span>
					</div>

					<div class="col-md-12 fs-6 text-primary mb-1 py-1 px-4">
						<strong class="">Gender : </strong><span class=""> {{$contact->gender->name}}</span>
					</div>

					<div class="col-md-12 fs-6 text-primary mb-1 py-1 px-4">
						<strong class="">Relative : </strong><span class=""> {{$contact->relative->name}}</span>
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
        