@extends('frontend.layouts.dashboard')
@section('title', 'blog')

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

                    <a href="{{ route('admin.addBlog') }}" class="dt-button add-new btn btn-primary mt-3 mb-3" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"><span><i
                                class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add
                                Blog</span></span>
                    </a>
                </div>

                <table class="datatables-products table border-top dataTable no-footer dtr-column collapsed"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 954px;">

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
<tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>
                    @if($blog->img_url)
                    <img src="{{ asset('images/' . $blog->img_url) }}" alt="{{ $blog->title }}" style="width: 200px;">
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    <a href="" class="btn btn-primary">Update</a>
                </td>
                <td>
                    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                       
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
                </table>



            </div>
        </div>
    </div>



    @endsection

