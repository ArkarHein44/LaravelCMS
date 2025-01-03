@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{ route('leaves.update',$leaves->id) }}" method="POST" enctype="multipart/form-data">
                    
            @csrf
            @method('PUT')

                <div class="row">

                    <div class="col-md-4">

                        <div class="row">

                            <div class="col-md-12 form-group mb-3">
                                <label for="image" class="gallery">
                                    @if(!empty($leavefiles && $leavefiles->count() > 0))
                                        @foreach($leavefiles as $leavefile)
                                            <img src="{{asset($leavefile->image)}}" alt="{{$leavefile->id}}" class="img-thumbnail" width="100" height="100">
                                        @endforeach
                                    @else
                                        <span>No File</span>

                                    @endif

                                    {{-- @if($leaves->image)
                                        <img src="{{asset($leaves->image)}}" alt="{{$leaves->slug}}" class="img-thumbnail" width="100px" height="100px"/>
                                    @else
                                        <span>Choose Images</span>
                                    @endif --}}
                                </label>
                                <input type="file" name="images[]" id="images" class="form-control form-control-sm rounded-0" multiple hidden/>
                            </div> 

                            <div class="col-md-6 form-group mb-3">
                                <label for="name">Start Date<span class="text-danger">*</span></label>
                                    @error('startdate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$leaves->startdate)}}"/>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="name">End Date<span class="text-danger">*</span></label>
                                    @error('enddate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" 
                                value="{{old('enddate',$leaves->enddate)}}"/>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="row">

                            <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title<span class="text-danger">*</span></label>
                                    @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Leave title" value="{{old('title',$leaves->title)}}"/>

                            </div>

                            <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class<span class="text-danger">*</span></label>
                                        @error('post_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <select name="post_id[]" id="post_id" class="form-select form-select-sm rounded-0" multiple>
                                        @foreach($posts as $id=>$title)
                                            <option value="{{$id}}" {{ in_array($id,json_decode($leaves->post_id,true) ?? []) ? 'selected':''}}> {{$title}}</option>
                                            
                                         
                                        @endforeach
                                    </select>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag<span class="text-danger">*</span></label>
                                        
                                    <select name="tag[]" id="tag" class="form-select form-select-sm rounded-0" multiple>
                                        @foreach($tags as $id=>$name)
                                            <option value="{{$id}}" {{ in_array($id, json_decode($leaves->tag) ?? []) ? 'selected': ''}} >                                      
                                            {{$name}}</option>
                                        @endforeach
                                    </select>
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content<span class="text-danger">*</span></label>

                                    <textarea  name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something...">{{old('title',$leaves->content)}}</textarea> 

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
    {{-- end Page Content Area  --}}

@endsection

@section('css')
<style type="text/css">
</style>
{{-- flatpickr css  --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- link select 2 css  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- link summer note css  -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

@endsection


@section('scripts')

<!-- link select 2 js  -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- link summer note js  -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function(){

            // Start Multi Profile Preview
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
            // End Multi Profile Preview
                
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

@endsection
        


{{-- ALTER TABLE roles ADD CONSTRAINT unique_name UNIQUE (name);
 SHOW INDEX FROM roles; --}}
