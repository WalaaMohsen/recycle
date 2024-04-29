@extends('layout')
@section('content')
<div class="card">
        <div class="card-header">Forget Form</div>
        <div class="card-body">
           @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
           @endif 
           @if(session('error'))
              <div class="alert alert-success">
                {{ session('error') }}
              </div>
           @endif 
           <form action="{{route('forget_password')}}" method="post">
                @csrf
                @method('POST')
        
                <label>Email : </label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control"><br><br>
                @error('email')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                
                <input type="submit" value="Forget" class="btn btn-success">
                <div>
                    <p>Do not have account? <a href="{{route('getregister')}}" style="text-decoration: none;">Create an account</a></p>
                </div>
                <a href="{{route('getlogin')}}" style="text-decoration: none;">Login</a>
           </form>
        </div>
     </div>
@stop