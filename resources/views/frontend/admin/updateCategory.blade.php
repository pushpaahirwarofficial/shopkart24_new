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
        <form action="{{ route('admin.updateCategory') }}" method="POST">

            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="hidden" class="form-control" id="categoryId" name="categoryId" maxlength="5000" value="{{ $category->categoryId  }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="subcategoryName">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName" maxlength="5000" value="{{ $category->categoryName }}">
                </div>
            </div>



            <button type="submit" class="btn btn-primary mt-5">Submit</button>
        </form>




 @endsection