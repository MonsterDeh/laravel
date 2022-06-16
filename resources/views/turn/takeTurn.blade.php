
@extends('layouts.app')



@section('content')
    
<div class="container">

    <form action= {{ route('User.store') }} method="POST" >
        @csrf
        {{-- @dd(request()->input('name')) --}}
        <div class="d-flex justify-content-around">
            <input name="name" value= {{ old('name')??''}} class="form-control w-25" type="text" placeholder="Name" aria-label="default input example">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input name="family_name" value={{old('family_name')}} class="form-control w-25" type="text" placeholder="Family Name" aria-label="default input example">
            @error('family_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class=" my-4 d-flex justify-content-around">
            <input name="national_code" value={{old('national_code')}} class="form-control w-25  " type="text" placeholder="National Code " aria-label="default input example">
            @error('national_code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input name="phone" value={{old('phone')}}  class="form-control w-25  " type="text" placeholder="Phone " aria-label="default input example">
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-around">

            <input  name="car_type" value={{old('car_type')}}  class="form-control " type="text" placeholder="Car Type" aria-label="default input example">
            @error('car_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input name="plaque" value={{old('plaque')}}  class="form-control  " type="text" placeholder="Plaque" aria-label="default input example">
            @error('plaque')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex  py-4 justify-content-center">
            <button class="btn btn-success" type="submit">Submint</button>
        </div>
        
    </form>

     {{-- @dd(old()) --}}
</div>



@endsection

