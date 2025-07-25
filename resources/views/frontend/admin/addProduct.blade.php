@extends('frontend.layouts.dashboard')
@section('title', 'product')

@section('content')

@push('styles')
<!-- Summernote CSS -->
       <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endpush


@push('scripts')
<!-- Summernote JS -->
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@endpush
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

        <form action="{{ route('admin.product') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Add a new Product</h4>
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
                            <label for="categoryId">Category</label>
                    <select name="categoryId" id="categoryId" class="category form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                <!--        <div class="col">-->
                            <!--    <label for="subCategoryId">Sub Category</label>-->
                <!--    <select name="subCategoryId" id="subCategoryId" class="form-control">-->
                        <!-- Options will be dynamically populated using JavaScript -->
                <!--    </select>-->
                <!--            <div class="invalid-feedback"></div>-->
                <!--            <div class="valid-feedback"></div>-->
                <!--        </div>-->

                    </div>

                 
                    <div class="row mb-3">
                        <div class="col">
                            <label for="subcategoryName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" maxlength="5000">

                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col">
                            <label for="subcategoryName">Product Price</label>
                    <input type="text" class="form-control" id="productPrice" name="productPrice" maxlength="5000">
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                    <!--    <div class="col">-->
                    <!--       <label for="subcategoryName">Product Sale Price</label>-->
                    <!--<input type="text" class="form-control" id="productSalePrice" name="productSalePrice" maxlength="5000">-->
                    <!--        <div class="invalid-feedback"></div>-->
                    <!--        <div class="valid-feedback"></div>-->
                    <!--    </div>-->

                        <div class="col">
                            <label for="summernote">Product Description</label>
                             <textarea id="summernote" name="productDescription" ></textarea>
                    <!--<input type="text" class="form-control" id="summernote" name="productDescription" maxlength="500000">-->
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                    <!--    <div class="col">-->
                    <!--      <label for="subcategoryName">Product Type</label>-->
                    <!--<select name="productType" id="productType" class="product_type form-control">-->
                    <!--    <option value="latest">latest</option>-->
                    <!--    <option value="Popular">Popular</option>-->
                    <!--    <option value="Trending">Trending</option>-->
                    <!--</select>-->
                    <!--        <div class="invalid-feedback"></div>-->
                    <!--        <div class="valid-feedback"></div>-->
                    <!--    </div>-->

                    <!--    <div class="col">-->
                    <!--       <label for="subcategoryName">Product Rating</label>-->
                    <!--<input type="text" class="form-control" id="productRating" name="productRating" maxlength="5000">-->
                    <!--        <div class="invalid-feedback"></div>-->
                    <!--        <div class="valid-feedback"></div>-->
                    <!--    </div>-->

                    </div>
                   <div class="row mb-3">
                        <div class="col">
                            <label for="sale_of_week">Sale of the week</label>
                            <select class="form-control" id="sale_of_week" name="sale_of_week">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>
                        <!-- <div class="col">-->
                        <!--   <label for="charges">Delivery Charge</label>-->
                        <!--    <input type="number" class="form-control" id="charges" name="charges" >-->
                        <!--    <div class="invalid-feedback"></div>-->
                        <!--    <div class="valid-feedback"></div>-->
                        <!--</div>-->
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="image" class="col-form-label">Image</label>
                          <input type="file" class="form-control form-control-file validate not-empty" placeholder="" id="image" name="image[]"  multiple>
                        
                            <div class="invalid-feedback"></div>
                            <div class="valid-feedback"></div>
                        </div>

                      
                    </div>
                   



                </div>
            </div>

        </div>


    </div>


         
        </form>
 <script>
      $('#summernote').summernote({
       
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
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
