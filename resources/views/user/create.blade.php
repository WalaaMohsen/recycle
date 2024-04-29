@extends('layout')
@section('content')
     <div class="card">
        <div class="card-header">Register Form</div>
        <div class="card-body">
           <form action="{{route('store')}}" method="post">
                @csrf
                @method('POST')
                <label>Name : </label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control"><br>
                @error('name')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <label>Email : </label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control"><br>
                @error('email')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <label> Email_Verfied: </label>
                <input type="email" name="verfied_at" value="{{old('verfied_at')}}" class="form-control"><br>
                @error('email_verified_at')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <label>Phone : </label>
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control"><br>
                @error('phone')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror 
                <label>Password : </label>
                <input type="password" name="password" value="{{old('password')}}"  class="form-control"><br>
                @error('password')
                   <div class="form-text text-danger">{{$message}}</div><br>
                @enderror
                <input type="submit" value="Register" class="btn btn-success">
           </form>
        </div>
     </div>
@stop