@extends('frontend.layouts.dashboard')
@section('title', 'category')

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

                    <button type="button" class="dt-button add-new btn btn-primary mb-3 mt-3" data-bs-toggle="modal"
                        data-bs-target="#addTask">
                        <span> <i class="bx bx-plus me-0 me-sm-1"></i></span>
                        <span class="d-none d-sm-inline-block">Add Category</span>
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
                            <th>Category Name</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($category as $data)
                        <tr>
                            <td>{{ $data->categoryId  }}</td>
                            <td>{{ $data->categoryName }}</td>
                    <!--        <td>-->
                                
                    <!--             <button type="button" class="dt-button add-new btn btn-primary" data-bs-toggle="modal"-->
                    <!--    data-bs-target="#update">-->
                    <!--    <span class="d-none d-sm-inline-block">Update</span>-->
                    <!--</button></td>-->
                            <td><a href="{{ route('admin.updateShowCategory', ['id' => $data->categoryId]) }}" class="btn btn-primary btn-sm">update</a></td>
                            
                            <td><a href="{{ route('admin.deleteCategory', ['id' => $data->categoryId]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>



            </div>
        </div>
    </div>


<div class="modal fade" id="addTask" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.category') }}" method="POST"enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="p_name">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" maxlength="5000">
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
            <form action="{{ route('admin.updateCategory') }}" method="POST"enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="p_name">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" maxlength="5000">
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


    @endsection

