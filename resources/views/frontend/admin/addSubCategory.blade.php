@include('admin.sidebar')
@if (request()->has('success'))
    <div class="alert alert-success">
        {{ request()->get('success') }}
    </div>
@endif

@if (request()->has('error'))
    <div class="alert alert-danger">
        {{ request()->get('error') }}
    </div>
@endif

<section class="home-section">
    @include('admin.navbar')
    <div class="home-content">
        <div class="container mt-4">
        @if(session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
        @endif
            <form action="{{ route('admin.addSubCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select name="categoryId" id="categoryId">
                            @foreach ($categories as $category)
                                <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="p_name">Sub Category Name</label>
                        <input type="text" class="form-control" id="subcategoryName" name="subcategoryName" maxlength="5000">
                    </div>
                </div>
                <!-- Image Upload Section -->
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

</body>

</html>