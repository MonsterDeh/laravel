
@extends('layouts.app')



@section('content')
    
<div class="container">

    <form action= {{ route('User.store') }} method="POST" >
        @csrf
        <div class="d-flex justify-content-around">
            <input name="name" class="form-control w-25" type="text" placeholder="Name" aria-label="default input example">
            <input name="family_name" class="form-control w-25" type="text" placeholder="Family Name" aria-label="default input example">
        </div>
        <div class=" my-4 d-flex justify-content-around">
            <input name="national_code" class="form-control w-25  " type="text" placeholder="National Code " aria-label="default input example">
            <input name="phone" class="form-control w-25  " type="text" placeholder="Phone " aria-label="default input example">

        </div>
        <div class="d-flex justify-content-around">

            <input  name="car_type" class="form-control " type="text" placeholder="Car Type" aria-label="default input example">
            <input name="plaque" class="form-control  " type="text" placeholder="Plaque" aria-label="default input example">
            
        </div>
        <div class="d-flex  py-4 justify-content-center">
            <button class="btn btn-success" type="submit">Submint</button>
        </div>
        
    </form>
</div>



@endsection

