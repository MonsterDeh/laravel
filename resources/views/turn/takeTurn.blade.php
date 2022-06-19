
@extends('layouts.app')



@section('content')
    
<div class="container">
    @guest
    <form action= {{ route('User.store') }} method="POST" >
        @csrf
        {{-- @dd(request()->input('name')) --}}
        <div class="d-flex justify-content-around">
            <input name="name" value= '{{ old('name')??''}}' class="form-control w-25" type="text" placeholder="Name" aria-label="default input example">
            @error('name')
                <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
            <input name="family_name" value='{{old('family_name')}}' class="form-control w-25" type="text" placeholder="Family Name" aria-label="default input example">
            @error('family_name')
                <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
        </div>
        <div class=" my-4 d-flex justify-content-around">
            <input name="national_code" value='{{old('national_code')}}' class="form-control w-25  " type="text" placeholder="National Code " aria-label="default input example">
            @error('national_code')
                <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
            <input name="phone" value='{{old('phone')}}'  class="form-control w-25  " type="text" placeholder="Phone " aria-label="default input example">
            @error('phone')
                <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
        </div>
        <div class="d-flex justify-content-around">

            <input  name="car_type" value='{{old('car_type')}}'  class="form-control " type="text" placeholder="Car Type" aria-label="default input example">
            @error('car_type')
            <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
            <input name="plaque" value='{{old('plaque')}}'  class="form-control  " type="text" placeholder="Plaque" aria-label="default input example">
            @error('plaque')
            <div class="alert alert-danger">'{{ $message }}'</div>
            @enderror
        </div>
        <div class="d-flex  py-4 justify-content-center">
            <button class="btn btn-success" type="submit">Submint</button>
        </div>
        
    </form>
    @else
    <form action= {{ route('UpdateUser') }} method="POST" >
        @csrf
        @method('put')
        {{-- @dd(request()->input('name')) --}}
        <div class="d-flex justify-content-around">
            <input name="name" value= "{{old('name')?? auth()->user()->name}}" class="form-control w-25" type="text" placeholder="Name" aria-label="default input example">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
        </div>
        <div class=" my-4 d-flex justify-content-around">
            <input name="national_code" value="{{old('national_code')??auth()->user()->national_code}}" class="form-control w-25  " type="text" placeholder="National Code " aria-label="default input example">
            @error('national_code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input name="phone" value="{{old('phone')??auth()->user()->phone}}"  class="form-control w-25  " type="text" placeholder="Phone " aria-label="default input example">
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-around">

            <input  name="car_type" value="{{old('car_type')??auth()->user()->car_type}}"  class="form-control " type="text" placeholder="Car Type" aria-label="default input example">
            @error('car_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input name="plaque" value="{{old('plaque')??auth()->user()->plaque}}"  class="form-control  " type="text" placeholder="Plaque" aria-label="default input example">
            @error('plaque')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-around m-5">
            <input name="email" value="{{old('email')??auth()->user()->email }}"  class="form-control w-25  " type="text" placeholder="email " aria-label="default input example">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div>

        </div>
        <div class="d-flex  py-4 justify-content-center">
            <button class="btn btn-success" type="submit">
            @if (auth()->user()->is_profile_complete==0)
                Please complete the form and select here
            @else
                Update
            @endif
            </button>
        </div>
        @if (session()->has('success'))
        <div class="alert h3 alert-success"> {{session('success')}}</div>  
        @endif
    </form>
    @if (auth()->user()->is_profile_complete==1)
        <form action={{route("User.show",auth()->id())}} method="get">
            <div class="d-flex  py-4 justify-content-center">
                <button class="btn btn-success" type="submit">TakeTurn</button>
            </div>
        </form>

    @endif
    {{-- @dd(auth()->user()->toArray()) --}}
   @endguest
    
  
     {{-- @dd(old()) --}}
</div>



@endsection

