@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="row">
                                
                                <div class="col-md-12 form-group mb-3">

                                    <label for="images" class="gallery">                                  
                                        <span>Choose Images</span>
                                    </label>
                                    <input type="file" name="images[]" id="images" class="form-control form-control-sm rounded-0" multiple hidden/>
                                </div> 

                                <div class="col-md-6 form-group mb-3">
                                    <label for="startdate">Start Date<span class="text-danger">*</span></label>                                
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}"/>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date<span class="text-danger">*</span></label>                                    
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>

                            </div>
                            
                        </div>

                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title<span class="text-danger">*</span></label>                                    
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Leave title" value="{{old('title')}}"/>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class<span class="text-danger">*</span></label>                                        
                                    <select name="post_id[]" id="post_id" class="form-select form-select-sm rounded-0" multiple>
                                       {{-- option selected disabled>Choose Class</option> --}}
                                        @foreach($posts as $id=>$title)
                                            <option value="{{$id}} {{old('post_id') == $id ? 'selected':''}}">{{$title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag<span class="text-danger">*</span></label>                                        
                                    <select name="tag[]" id="tag" class="form-select form-select-sm rounded-0" multiple>
                                        <!-- <option selected disabled>Choose authorize person</option> -->
                                        @foreach($tags as $tag)
                                            <option value="{{$tag['id']}} {{old('tag') == $tag->id ? 'selected':''}}">{{$tag['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content<span class="text-danger">*</span></label>                                   
                                    <textarea  name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something..."> </textarea> 

                                </div>
                            
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- link summer note css --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

{{-- flatpickr css  --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- link select 2 js --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- link summer note js --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

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
        
