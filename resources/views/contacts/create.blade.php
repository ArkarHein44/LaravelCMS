@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="row">                            
                               

                                <div class="col-md-6 form-group mb-3">
                                    <label for="firstname">First Name<span class="text-danger">*</span></label>                                
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter firstname..."/>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="lastname">Last Name<span class="text-danger">*</span></label>                                
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter lastname..."/>
                                </div>

                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Birthday<span class="text-danger">*</span></label>                                    
                                    <input type="date" name="birthday" id="birthday" class="form-control form-control-sm rounded-0"/>
                                </div>

                            </div>
                            
                        </div>

                        <div class="col-md-8">

                            <div class="row">                                

                                <div class="col-md-6 form-group mb-3">
                                    <label for="gender_id">Class<span class="text-danger">*</span></label>                                        
                                    <select name="gender_id" id="gender_id" class="form-select form-select-sm rounded-0">
                                        <option selected disabled>Choose Gender</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender['id']}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="relative_id">Relative<span class="text-danger">*</span></label>                                        
                                    <select name="relative_id" id="relative_id" class="form-select form-select-sm rounded-0">
                                        <option selected disabled>Choose Relative</option>
                                        @foreach($relatives as $relative)
                                            <option value="{{$relative['id']}}">{{$relative['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>                                     
                                
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{route('contacts.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                </div>

                            </div>

                        </div>

                    </div>
                    
                </form>
            </div>

            
        </div>
    </div>
    <!-- end Page Content Area  -->

@endsection

@section('css')
{{-- link select 2 css --}}
<link rel="stylesheet" href="{{asset('assets\libs\select2-develop\dist\css\select2.min.css')}}" />

{{-- link summer note css --}}
<link rel="stylesheet" href="{{asset('assets\libs\summernote-0.8.18-dist\summernote.min.css')}}" />

{{-- flatpickr css  --}}
<link rel="stylesheet" href="{{asset('assets\libs\flatpickr\flatpickr.min.css')}}" />


{{-- Start Gallery  --}}
<style type="text/css">
    .gallery{
            width: 100%;
            background-color: #eee;
            color: #aaa;


            text-align: center;

            padding: 10px 0;
        }

        .gallery.removetext span{
            display: none;

        }

        .gallery img{
            width: 100px;
            height: 100px;
            border: 2px dashed #aaa;

            border-radius: 10px;

            object-fit: cover;

            padding: 5px;
            margin: 0 5px;
        }
</style>
{{-- End Gallery  --}}
@endsection



@section('scripts')

{{-- flatpickr js  --}}
<script src="{{asset('assets\libs\flatpickr\flatpickr.min.js')}}"></script>

{{-- link select 2 js --}}
<script src="{{asset('assets\libs\select2-develop\dist\js\select2.min.js')}}"></script>

{{-- link summer note js --}}
<script src="{{asset('assets\libs\summernote-0.8.18-dist\summernote.min.js')}}"></script>

    <script type="text/javascript">

        
            $(document).ready(function(){
                
                $('#post_id').select2({
                    placeholder:"Choose class"
                });

                $('#tag').select2({
                    placeholder:"Choose authorize person"
                });

                $('#content').summernote({
                    placeholder:'Say Something...',
                    height: 120,
                    toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ]
                });

                $("#startdate,#enddate").flatpickr({
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    maxDate: new Date().fp_incr(30)
                });


            });
                      
    </script>

    
<script type="text/javascript">

        
    $(document).ready(function(){
        // 10pxStart Single Profile Preview

        let Previewimages = function(input,output){
            // console.log(input,output)

            if(input.files){
                let totalfiles = input.files.length;
                //console.log(totalfiles);

                if(totalfiles > 0){
                    $(output).addClass("removetext");

                }else{
                    $(output).removeClass("removetext");
                }

                for(let x=0; x < totalfiles; x++){
                    //console.log(x);

                    let filereader = new FileReader();
                    filereader.readAsDataURL(input.files[x]);

                    filereader.onload = function(e){
                        // $(output).html("");
                        $($.parseHTML("<img />")).attr("src",e.target.result).appendTo(output);

                    }
                }
            }

        }

        $("#images").change(function(){

            Previewimages(this,"label.gallery");
        });

        // End Single Profile Preview       
    });

       
</script>


@endsection
        
