@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="row">

                                <div class="col-md-12 form-group mb-3">
                                    <label for="image">Choose Image<span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0"  value="{{ old('image')}}" />
                                    @error("image")
                                         <span class="text-danger">{{ $message }}<span>
                                    @enderror
                                </div> 

                                <div class="col-md-6 form-group mb-3">
                                    <label for="startdate">Start Date<span class="text-danger">*</span></label>
                                    @error('startdate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}"/>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date<span class="text-danger">*</span></label>
                                    @error('enddate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('startdate',now()->format('Y-m-d'))}}" />
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="starttime">Start Time<span class="text-danger">*</span></label>
                                    @error('starttime')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="time" name="starttime" id="starttime" class="form-control form-control-sm rounded-0" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="endtime">End Time<span class="text-danger">*</span></label>
                                    @error('endtime')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="time" name="endtime" id="endtime" class="form-control form-control-sm rounded-0" />
                                </div>

                                <div class="col-md-12 for-group">
                                    <label for="">Days</label>
                                    <div class="d-flex flex-wrap">
                                         @foreach($days as $idx=>$day)
                                              <div class="form-check form-switch mx-3">
                                                   <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input" value="{{$day->id}}" checked/> <label for="day_id{{$idx}}">{{$day->name}}</label>
                                              </div>
                                         @endforeach
                                    </div>

                                    <!-- start hidden field -->
                                    <input type="hidden" name="dayable_type" id="dayable_type" value="App\Models\Post" />
                                    <!-- end hidden field -->
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
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Post title" value="{{old('title')}}"/>

                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="type_id">Type<span class="text-danger">*</span></label>
                                        @error('type_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <select name="type_id" id="type_id" class="form-select form-select-sm rounded-0">
                                       
                                        @foreach($types as $type)
                                            <option value="{{$type->id}} {{old('type_id') == $type->id ? 'selected':''}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="fee">Fee<span class="text-danger">*</span></label>
                                        @error('fee')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <input type="number" id="fee" name="fee" class="form-control form-control-sm rounded-0" placeholder="Class fee..." value="{{ old('fee') }}"/>
                                </div>

                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content<span class="text-danger">*</span></label>
                                        @error('content')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" aria-placeholder="Say Something...">{{old('content')}}</textarea>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="tag_id">Tag <span class="text-danger">*</span></label>
                                    <select name="tag_id" id="tag_id" class="form-control form-control-sm rounded-0">
                                         @foreach($tags as $tag)
                                              <option value="{{$tag->id}}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                                         @endforeach
                                    </select>
                                    @error("tag_id")
                                         <span class="text-danger">{{ $message }}<span>
                                    @enderror
                               </div>

                               <div class="col-md-3">
                                    <label for="attshow">Show on Att Form <span class="text-danger">*</span></label>
                                    <select name="attshow" id="attshow" class="form-control form-control-sm rounded-0">
                                         @foreach($attshows as $attshow)
                                              <option value="{{$attshow->id}}" {{ old('attshow') == $attshow->id ? 'selected' : '' }}>{{ $attshow->name }}</option>
                                         @endforeach
                                    </select>
                                    @error("attshow")
                                         <span class="text-danger">{{ $message }}<span>
                                    @enderror
                               </div>

                               <div class="col-md-3">
                                    <label for="name">Status <span class="text-danger">*</span></label>
                                    <select type="text" name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                         @foreach($statuses as $status)
                                              <option value="{{$status->id}}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                         @endforeach
                                    </select>
                                    @error("status_id")
                                         <span class="text-danger">{{ $message }}<span>
                                    @enderror
                               </div>                               

                               <div class="col-md-3 d-flex justify-content-end align-items-end">
                                    <div class="">
                                         <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0 me-3">Cancel</a>
                                         <button type="submit" class="btn btn-primary btn-sm rounded-0">Submit</button>
                                    </div>
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
                    maxDate: new Date().fp_incr(210)
                });


            });


    

                

       
    </script>


@endsection
        
