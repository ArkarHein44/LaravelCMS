@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        <div class="col-md-12">
             <form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method("PUT")

                  <div class="row">

                       <div class="col-md-4">

                            <div class="row">
                                 <div class="col-md-12 mb-3">

                                      <div class="row">
                                           <div class="col-md-6 text-sm-center">
                                                <img src="{{asset($post->image)}}" width="200" alt="{{$post->title}}"/>
                                           </div>
                                           <div class="col-md-6">
                                                <label for="image" class="gallery"><span>Choose Images</span></label>
                                                <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" value="{{ $post->image }}" hidden/>
                                           </div>
                                      </div>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                      <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                      <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{ $post->startdate }}"/>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                      <label for="enddate">End Date <span class="text-danger">*</span></label>
                                      <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{ $post->enddate }}"/>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                      <label for="starttime">Start Time <span class="text-danger">*</span></label>
                                      <input type="time" name="starttime" id="starttime" class="form-control form-control-sm rounded-0" value="{{ $post->starttime }}"/>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                      <label for="endtime">End Time <span class="text-danger">*</span></label>
                                      <input type="time" name="endtime" id="endtime" class="form-control form-control-sm rounded-0" value="{{ $post->endtime }}"/>
                                 </div>

                                 <div class="col-md-12 for-group">
                                      <label for="">Days</label>
                                      <div class="d-flex flex-wrap">
                                           @foreach($days as $idx=>$day)
                                                <div class="form-check form-switch mx-3">
                                                     <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input dayactions" value="{{$day->id}}" 
                                                          {{-- @foreach($dayables as $dayable)
                                                               @if($dayable['id'] === $day['id'])
                                                                    checked
                                                               @endif
                                                          @endforeach --}}
                                                     /> 
                                                     <label for="day_id{{$idx}}">{{$day->name}}</label>
                                                </div>
                                           @endforeach

                                           {{-- @foreach($days as $idx=>$day)
                                                <div class="form-check form-switch mx-3">
                                                     <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input" value="{{$day->id}}" 
                                                          {{ in_array($day->id,$post->days->pluck('id')->toArray()) ? 'checked' : '' }}
                                                     /> 
                                                     <label for="day_id{{$idx}}">{{$day->name}}</label>
                                                </div>
                                           @endforeach --}}
                                      </div>

                                      <!-- start hidden field -->
                                      <input type="hidden" name="dayable_type" id="dayable_type" value="App\Models\Post" />
                                      <!-- end hidden field -->
                                 </div>
                            </div>
                            
                       </div>

                       <div class="col-md-8">
                            <div class="row">
                                 
                                 <div class="col-md-12 mb-3">
                                      <label for="title">Title <span class="text-danger">*</span></label>
                                      <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Post Title" value="{{ $post->title }}"/>
                                 </div>

                                 <div class="col-md-6">
                                      <label for="type_id">Type <span class="text-danger">*</span></label>
                                      <select name="type_id" id="type_id" class="form-control form-control-sm rounded-0">
                                           @foreach($types as $type)
                                                <option value="{{$type->id}}"
                                                     @if($type["id"] === $post["type_id"])
                                                          selected
                                                     @endif
                                                >{{ $type->name }}</option>
                                           @endforeach
                                      </select>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                      <label for="fee">Fee <span class="text-danger">*</span></label>
                                      <input type="number" name="fee" id="fee" class="form-control form-control-sm rounded-0" placeholder="Class Fee" value="{{ $post->fee }}"/>
                                 </div>

                                 <div class="col-md-12 mb-3">
                                      <label for="content">Content <span class="text-danger">*</span></label>
                                      <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something....">{{$post->content}}</textarea>
                                 </div>

                                 <div class="col-md-3">
                                      <label for="tag_id">Type <span class="text-danger">*</span></label>
                                      <select name="tag_id" id="tag_id" class="form-control form-control-sm rounded-0">
                                           @foreach($tags as $tag)
                                                <option value="{{$tag->id}}"
                                                     @if($tag->id === $post["tag_id"])
                                                          selected
                                                     @endif
                                                >{{ $tag->name }}</option>
                                           @endforeach
                                      </select>
                                 </div>

                                 <div class="col-md-3">
                                      <label for="attshow">Show on Att Form <span class="text-danger">*</span></label>
                                      <select name="attshow" id="attshow" class="form-control form-control-sm rounded-0">
                                           @foreach($attshows as $attshow)
                                                <option value="{{$attshow->id}}"
                                                     @if($attshow["id"] === $post["attshow"])
                                                          selected
                                                     @endif
                                                >{{ $attshow->name }}</option>
                                           @endforeach
                                      </select>
                                 </div>

                                 <div class="col-md-3">
                                      <label for="name">Status <span class="text-danger">*</span></label>
                                      <select type="text" name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                           @foreach($statuses as $status)
                                                <option value="{{$status->id}}" {{ ($status->id === $post->status_id) ? "selected" : "" }} >{{ $status->name }}</option>
                                           @endforeach
                                      </select>
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
