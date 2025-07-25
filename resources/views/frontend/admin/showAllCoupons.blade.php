@extends('frontend.layouts.dashboard')
@section('title', 'coupons')

@section('content')


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


    <div class="card">
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex rounded-0 flex-wrap py-md-0">
                    <div class="me-5 ms-n2 pe-5">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <!--<form action="" method="GET">-->
                            <!--    <input type="text" name="search" value="" placeholder="Search cases..." class="form-control">-->
                            <!--    <button type="submit" class="btn btn-primary">Search</button>-->
                            <!--    <a href="" class="ms-2">-->
                            <!--        <button class="btn btn-danger" type="button">Reset</button>-->
                            <!--    </a>-->
                            
                            <!--</form>-->
                            
                        </div>
                    </div>

                        <div class="text-center"><h3>COUPON</h3></div>
                    
                    <button type="button" class="dt-button add-new btn btn-primary mb-3 mt-3" data-bs-toggle="modal"
                        data-bs-target="#addTask">
                        <span> <i class="bx bx-plus me-0 me-sm-1"></i></span>
                        <span class="d-none d-sm-inline-block">Add Coupon</span>
                    </button>

                    <!--<a href="{{ route('admin.category') }}" class="dt-button add-new btn btn-primary" tabindex="0"-->
                    <!--    aria-controls="DataTables_Table_0" type="button"><span><i-->
                    <!--            class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add-->
                    <!--            Category</span></span>-->
                    <!--</a>-->
                </div>

                <table class="datatables-products table border-top dataTable no-footer dtr-column collapsed"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 954px;">

                    <thead>
                        <tr>
                            <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Coupons Code</th>
                            <th>Discount Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </tr>
                    </thead>
                     <tbody>
                        @php $count = 1; @endphp
                        @if(!empty($coupons))
                        @foreach ($coupons as $data)
                        @php $product1 = DB::table('category')->where('categoryId', $data->product_code)->first();  @endphp
                        <tr>
                            <td>{{ $count++  }}</td>
                            <td>{{ $product1->categoryName }}</td>
                            <td>{{ $data->code  }}</td>
                            <td>{{ $data->discount_type }}</td>
                            <td>{{ $data->discount_amount }}</td>
                            <td>
                                <a href="{{ route('admin.updateStatusCoupons', ['id' => $data->id]) }}" 
                                   class="btn {{ $data->is_active == 1 ? 'btn-danger' : 'btn-success' }} btn-sm">
                                   {{ $data->is_active == 1 ? 'Deactivate' : 'Activate' }}
                                </a>
                            </td>

                            <td><a href="{{ route('admin.updateShowCoupons', ['id' => $data->id]) }}" class="btn btn-primary btn-sm">update</a></td>
                            
                            <td>
                                <a href="{{ route('admin.deleteCoupons', ['id' => $data->id]) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this coupon?');">
                                   Delete
                                </a>
                            </td>
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    
                </table>



            </div>
        </div>
    </div>


<div class="modal fade" id="addTask" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
<form id="couponForm" action="{{ route('admin.coupons') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Add Coupon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div id="error-message" class="alert alert-danger" style="display:none;"></div> <!-- Error message area -->
        <div class="row">
            <div class="col mb-3">
                <label for="product_name">Category Name</label>
                <select class="form-control" id="product_name" name="product_name" required>
                    <option value="">Select Category</option>
                    @if(!empty($category))
                        @foreach($category as $cat)
                            <option value="{{ $cat->categoryId }}">{{ $cat->categoryName }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="couponName">Coupon Name</label>
                <input type="text" class="form-control" id="couponName" name="code" maxlength="255" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="discountType">Discount Type</label>
                <select class="form-control" id="discountType" name="discount_type" required>
                    <option value="fixed">Fixed Amount</option>
                    <option value="percent">Percentage</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="discountAmount">Discount Amount</label>
                <input type="number" class="form-control" id="discountAmount" name="discount_amount" min="0" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="expiresAt">Expiration Date</label>
                <input type="date" class="form-control" id="expiresAt" name="expires_at" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>

        </div>
    </div>
</div>


<div class="modal fade" id="update" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.updateCoupons') }}" method="POST"enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Update Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="p_name">Coupon Name</label>
                        <input type="text" class="form-control" id="couponName" name="couponName" maxlength="5000">
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#couponForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        $('#error-message').hide().html('');

        // Send the AJAX request
        $.ajax({
            url: $(this).attr('action'), // Use the form action URL
            type: 'POST',
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                // Handle success response
                window.location.reload();
                $('#couponForm')[0].reset(); // Reset the form if needed
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '<ul>';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>'; // Get the first error message for each field
                    });
                    errorMessage += '</ul>';
                    $('#error-message').html(errorMessage).show(); // Display error messages
                } else {
                    alert('An error occurred. Please try again.'); // Handle other types of errors
                }
            }
        });
    });
});
</script>

@endsection

