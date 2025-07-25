@include('admin.sidebar')
<section class="home-section">
    @include('admin.navbar')
    <div class="home-content">
        <div class="container mt-4">
        @if(session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
        @endif
      
        <form action="{{ route('admin.updateSubCategory') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="hidden" name="subCategoryId" value="{{ $Data->subCategoryId }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="categoryId">Category</label>
                    <select name="categoryId" id="categoryId" class="form-control">
                    <option value="{{ $Data->categoryId }}">{{ $Data->categoryName }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="subCategoryId">Sub Category</label>
                    <input type="text" name="subCategoryName" value="{{ $Data->subCategoryName }}">
                </div>
            </div>

            


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        </div>
    </div>
</section>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#categoryId').change(function () {
        var categoryId = $(this).val();

        // Send an AJAX request to fetch subcategories based on the selected category
        $.ajax({
            url: '/admin/getSubCategories', // Replace with your actual route URL
            method: 'POST',
            data: {
                categoryId: categoryId,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                // Clear the existing options
                $('#subCategoryId').empty();

                // Populate the "Sub Category" select with the retrieved data
                data.forEach(function (subCategory) {
                    $('#subCategoryId').append(
                        '<option value="' + subCategory.subCategoryId + '">' + subCategory.subCategoryName + '</option>'
                    );
                });
            }
        });
    });
});
</script>



</body>

</html>