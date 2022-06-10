@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="">
         {{-- --------------------Show Sercice ---------------------------- --}}

    <div>
        <div class="bg-info text-dark text-center">
            <h3 class="">Service</h3>
        </div>

        <table class="table table-secondary">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
               
               <?php   ?>
              </tr>
            </thead>
            <tbody>

                @php   $count=1; @endphp
                @foreach ($Services as $service)
                    <tr>
                    <th scope="row">{{$count++}}</th>
                    <td>{{$service['name']}} </td>
                    <td>{{$service['price']}} </td>
                    <td>{{$service['description']}} </td>
                    </tr>
                @endforeach

            </tbody>
          </table>
    </div>
        
        {{-- -------------------- day---------------------------- --}}
  
        <form class="py-4 row " method="GET" action={{route('User.worktime',$User->id)}} >
            @csrf
            <div class="col" >
                
             
                    <select  name="day" class="form-select" multiple aria-label="multiple select example">
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    
                    </select>
                
        </div>
       
       {{-- --------------------Choose Sercice---------------------------- --}}
       <div class="col">

           <div class="d-flex  py-4 justify-content-center">
              <label class="h4 p-2 pt-3" for="service">Service</label>
            <select id="ServiceSelect" name="service" class="form-select w-50 form-select-lg w-25" aria-label="Default select example">
                @forelse ($Services as $service)
                <option value={{$service['id']}} >{{$service['name']}} </option>
                @empty
                    <p>bug</p>
                @endforelse
                
              </select>
            </div>



        </div>
        <div class="d-flex   py-4 justify-content-center">
            <button class="btn btn-success" type="submit">Choose time</button>
        </div>
        
        
    </form>
   

</div>

@endsection

@push('script')
<script>
    
    
</script>
@endpush