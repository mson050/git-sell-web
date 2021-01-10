@extends('layout.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Danh sách bộ sưu tập</h1>
                </div>

                <div class="card-body">
                    <a href="{{ route('collections.create') }}" class="btn btn-primary">Tạo mới bộ sưu tập</a>

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
                                <th><h5>Tên bộ sưu tập</h5></th>
                                <th><h5>Ảnh bộ sưu tập</h5></th>
                                <th><h5>Action</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $collection)
                                <tr>
                                    <td>{{ $collection->id }}</td>
                                    <td>{{ $collection->name }}</td>
                                    <td> 
                                        <div class="image" > 
                                            <img style="width: 150px; height: 100px" src="/uploads/collection_imgs/{{ $collection->image }}" class="" alt="Item Image">
                                        </div>
                                    </td>
                                    <td> <a href="{{ route('categories.edit',$collection->id)  }}" class="btn btn-primary">Edit</a>  
                                        <form action="{{  route('collections.destroy',$collection->id)   }}" method="POST" role="form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                     {{ $collections->appends($_GET) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection