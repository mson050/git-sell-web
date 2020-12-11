@extends('layout.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Danh sách loại sản phẩm</h1>
                </div>

                <div class="card-body">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tạo mới loại sản phẩm</a>

                    <form style="float: right" action="" method="GET" class="form-inline" role="form">
                        <div class="form-group">
                            <label class="sr-only" for=""></label>
                            <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}" id="" placeholder="Keyword">
                        </div>

                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                    <table style="margin-top: 20px" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><h5>ID</h5> </th>
                                <th><h5>Tên loại sản phẩm</h5></th>
                                <th><h5>Action</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td> <a href="{{ route('categories.edit',$category->id)  }}" class="btn btn-primary">Edit</a>  
                                        <form action="{{  route('categories.destroy',$category->id)   }}" method="POST" role="form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $categories->appends($_GET) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection