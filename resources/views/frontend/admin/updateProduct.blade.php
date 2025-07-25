@extends('frontend.layouts.dashboard')
@section('title', 'product')

@section('content')


@push('styles')
<!-- Summernote CSS -->
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

<form action="{{ route('admin.updateProduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Update Product</h4>
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
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                           <label for="categoryId">Category</label>
                            <select name="categoryId" id="categoryId" class="form-control">
                                <option value="{{ $productData->categoryId }}">{{ $productData->categoryName }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" class="form-control" id="productId" name="productId" value="{{ $productData->productId }}">
                        <div class="col">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" value="{{ $productData->productName }}">
                        </div>
                        <div class="col">
                            <label for="productPrice">Product Price</label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" value="{{ $productData->productPrice }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="summernote">Product Description</label>
                          <textarea id="summernote" name="productDescription" >{{ $productData->productDescription }}</textarea>

                            <!--<input type="text" class="form-control" id="productDescription" name="productDescription" value="{{ $productData->productDescription }}">-->
                        </div>
                    </div>
                    <!--<div class="row mb-3">-->
                    <!--    <div class="col">-->
                    <!--        <label for="productType">Product Type</label>-->
                    <!--        <select name="productType" id="productType" class="product_type form-control">-->
                    <!--            <option value="latest" {{ $productData->productType == 'latest' ? 'selected' : '' }}>Latest</option>-->
                    <!--            <option value="Popular" {{ $productData->productType == 'Popular' ? 'selected' : '' }}>Popular</option>-->
                    <!--            <option value="Trending" {{ $productData->productType == 'Trending' ? 'selected' : '' }}>Trending</option>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--    <div class="col">-->
                    <!--        <label for="productRating">Product Rating</label>-->
                    <!--        <input type="text" class="form-control" id="productRating" name="productRating" value="{{ $productData->productRating }}">-->
                    <!--    </div>-->
                    <!--</div>-->
                      <div class="row mb-3">
                    <div class="col">
                        <label for="sale_of_week">Sale of the week</label>
                        <select class="form-control" id="sale_of_week" name="sale_of_week">
                            <option value="1" {{ $productData->sale_of_week == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $productData->sale_of_week == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        <div class="invalid-feedback"></div>
                        <div class="valid-feedback"></div>
                    </div>
                    <!--<div class="col">-->
                    <!--       <label for="charges">Delivery Charge</label>-->
                    <!--        <input type="number" class="form-control" id="charges" name="charges" value="{{ $productData->charges }}" >-->
                    <!--        <div class="invalid-feedback"></div>-->
                    <!--        <div class="valid-feedback"></div>-->
                    <!--    </div>-->
                    <!--</div>-->


                      
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="existingImages">Existing Images</label>
                            @if (!empty($productData->image))
                                @foreach (explode('|', $productData->image) as $image)
                                    <div class="existing-image">
                                        <img src="{{ asset('image/' . $image) }}" alt="" width="200">
                                        <input type="checkbox" name="deleteImages[]" value="{{ $image }}"> Delete
                                    </div>
                                @endforeach
                            @else
                                No images found.
                            @endif
                        </div>
                        <div class="col">
                            <label for="newImages">New Images (if any)</label>
                            <input type="file" class="form-control form-control-file validate not-empty" id="newImages" name="newImages[]" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
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

    // Function to strip inline styles
    function stripInlineStyles(html) {
      var div = document.createElement('div');
      div.innerHTML = html;
      var elements = div.querySelectorAll('*');

      elements.forEach(function(element) {
        element.removeAttribute('style');
      });

      return div.innerHTML;
    }

    // Bind to form submit event
    $('form').on('submit', function() {
      var cleanHtml = stripInlineStyles($('#summernote').val());
      $('#summernote').val(cleanHtml);
    });
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
