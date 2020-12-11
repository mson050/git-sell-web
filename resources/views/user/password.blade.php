@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Thay doi mat khau
            </div>
            <div class="card-body">

                    @if (Session('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Thong bao!</strong> {{ Session('error')}}
                        </div>
                    @endif
                    
                    @if (Session('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>Thong bao!</strong> {{ Session('success')}}
                        </div>
                    @endif
                <form action="{{ route('user.change-password') }}" method="POST" role="form">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Mat khau</label>
                        <input type="password"
                    class="form-control" name="password"  value="">
                    @error('password')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mat khau moi</label>
                        <input type="password"
                        class="form-control" name="new-password" id="" value="  ">
                        @error('new-password')
                        <div class="text-danger"> {{ $message }}</div>
                      @enderror
                    </div>    
                    <div class="form-group">
                        <label for="">Nhap lai mat khau moi</label>
                        <input type="password"
                        class="form-control" name="re-password" id="" value="  ">
                        @error('re-password')
                        <div class="text-danger"> {{ $message }}</div>
                      @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update profile</button>
                  </form>
            </div>
        </div>
    </div>
</div>
    
@endsection