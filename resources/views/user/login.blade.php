@extends('layout')
@section('content')
<div class="card">
        <div class="card-header">Login Form</div>
        <div class="card-body">
        @if(session('error'))
          <div class="alert alert-success">
                {{ session('error') }}
          </div>
        @endif 

           <form action="{{route('login')}}" method="post">
                @csrf
                @method('POST')
        
                <label>Email : </label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control"><br><br>
                @error('email')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <label>Password : </label>
                <input type="password" name="password" value="{{old('password')}}" class="form-control"><br><br>
                @error('password')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <input type="submit" value="Login" class="btn btn-success">
                <div>
                    <p>Do not have account? <a href="{{route('getregister')}}" style="text-decoration: none;">Create an account</a></p>
                </div>
                <a href="{{route('forget')}}" style="text-decoration: none;"> I Forget My Passwored</a>
           </form>
        </div>
     </div>
@stop