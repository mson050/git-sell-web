@extends('layout.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card">
          <div class="card-body login-card-body">
          <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height:150px; float:left; border-radius:50%; margin-right:25px;" >
            <p class="login-box-msg">{{ $user->fullname}}' profile</p>
              <div style="margin-top: 150px">
                @if (Session('success'))
                <div class="alert alert-success" role="alert">
                    <strong>Thong bao!</strong> {{ Session('success')}}
                </div>
                @endif
              <form enctype="multipart/form-data" action="{{ route('user.update-profile') }}" method="POST" role="form" >
                @csrf
                @method('put')
                
                <div class="form-group">
                  <label for="">Avatar</label>
                  <br>
                  <input type="file" name="avatar" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text"
                class="form-control" name="email"  value=" {{ old('email', Auth::user()->email) }}">
                  @error('email')
                    <div class="text-danger"> {{ $message }}</div>
                  @enderror

                </div>
                <div class="form-group">
                    <label for="">Full name</label>
                    <input type="text"
                    class="form-control" name="fullname" id="" value="  {{ old('fullname', Auth::user()->fullname) }} ">
                    @error('fullname')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                </div>
              
                <button type="submit" class="btn btn-primary">Update profile</button>
              </form>
            </div>
          </div>
      </div>   
  </div>
</div>
    
@endsection