@extends('frontend.layouts.dashboard')
@section('title', 'blog')

@section('content')
 
<!--summernote-->
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

        <form action="{{ route('admin.storeBlog') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Add a new Blog</h4>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
            <a id="cancelButton" class="btn btn-label-danger" href="">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
  <div class="row">

        <div class="col-12 col-lg-12">
            <!-- case details -->
            <div class="card mb-4">
                <div class="card-header">

                    
                </div>
                <div class="card-body">
                    <div class="row mb-3">

                        <div class="col">
                           <label for="title" class="mb-0">Blog Title:</label>
                            <input type="text" id="title" name="title" required class="form-control">
                        </div>

                        <div class="col">
                                                       <label for="title_url "class="mb-0">Make Blog Url:</label>
                            <input type="text" id="title_url" name="title_url" required class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>

                 
                    <div class="row mb-3">
                        <div class="col">
                            <label for="meta_title" class="mb-0">Meta Title</label><br>
                            <input type="text" id="meta_title" name="meta_title" required class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col">
                             <label for="meta_desc"class="mb-0">Meta Description:</label>
                            <input type="text" id="meta_desc" name="meta_desc" class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                           <label for="description" class="mb-0"> Author Description:</label>
                            <input type="text" id="description" name="description" required class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col">
                            <label for="auth_name" class="mb-0">Author Name</label><br>
                            <input type="text" id="auth_name" name="auth_name" required class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
 <label for="category" class="mb-0">Category:</label>
                            <select id="category" name="category" required class=" category form-control">
                                <option value="earings">Earings</option>
                                <option value="ancklets">Ancklets</option>
                                <option value="bangels">Bangels</option>
                              
                                <option value="neckles">Neckles</option>
                                <option value="rings">Rings</option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col">
                          <label for="img_url" class="mb-0">Upload Image:</label>
                            <input type="file" id="img_url" name="img_url" required class="form-control">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="summernote"class="mb-0">Blog Long Description</label>
                          <textarea id="summernote" name="body" required></textarea>
                        
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    <!--    <div class="col">-->
                    <!--       <label for="subcategoryName">Product Rating</label>-->
                    <!--<input type="text" class="form-control" id="productRating" name="productRating" maxlength="5000">-->
                    <!--        <div class="invalid-feedback"></div>-->
                    <!--        <div class="valid-feedback"></div>-->
                    <!--    </div>-->

                    </div>
                   



                </div>
            </div>

        </div>


    </div>


         
        </form>

<script>
$(document).ready(function() {
    $('.category').select2();
});
$(document).ready(function() {
    $('.product_type').select2();
});
</script>
       
<script>
      $('#summernote').summernote({
        // placeholder: 'Describe your experience, skills, etc. In complete details. This is your chance to show off.',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview']],
            
        ]
      });
    </script>
<script>
$(document).ready(function() {
    $('.category').select2();
});
$(document).ready(function() {
    $('.product_type').select2();
});
</script>



    @endsection
