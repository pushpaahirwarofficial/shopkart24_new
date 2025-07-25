@extends('frontend.layouts.dashboard')
@section('title', 'dashboard')

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
                           
                            
                        </div>
                    </div>

                    <a href="{{ route('admin.product') }}" class="dt-button add-new btn btn-primary mb-3 mt-3" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"><span><i
                                class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add
                                Product</span></span>
                    </a>
                </div>

                <table class="datatables-products table border-top dataTable no-footer dtr-column collapsed"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 954px;">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
  <tbody>
                        @foreach ($products as $data)
                        <tr>
                            <td>{{ $data->productId }}</td>
                            <td>{{ $data->productName }}</td>
<td><img src="{{ asset('image/' . $data->firstImage) }}" alt="" width="200"></td>

                            <td><a href="{{ route('admin.deleteProduct', ['id' => $data->productId]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                            <td><a href="{{ route('admin.updateShowProduct', ['id' => $data->productId]) }}" class="btn btn-primary btn-sm">Update</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>



            </div>
        </div>
    </div>



    @endsection

