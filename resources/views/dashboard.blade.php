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
           
            <input type="hidden" name="id" value="{{$User->id}}">
            
            <div class="col" >
                <div class="w-25">
                    <input type="date" name="day" class="form-control" id="exampleFormControlInput1" required placeholder="date Search">
                </div>
                <div>
                    <input type="time" class="form-control w-25" id="appt" name="Hour" min="09:00" max="21:00" required>
                </div>
             
                    {{-- <select  name="day" class="form-select" multiple aria-label="multiple select example">
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    
                    </select> --}}
                
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

   {{-- --------------------order ---------------------------- --}}
    <div>
        @if (!$Orders->isEmpty())

            <table class="table table-secondary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                    <th scope="col">tracking_code</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Delete</th>
                    <th scope="col">edit</th>
                
                <?php   ?>
                </tr>
                </thead>
                <tbody>

                    @php   $count=1; @endphp
                    @foreach ($Orders as $Order)
                        <tr>
                        <th scope="row">{{$count++}}</th>
                        <td>{{$Order['tracking_code']}} </td>
                        <td>{{$Order['date']}} </td>
                        <td>{{$Order['start'].'-'.$Order['end']}} </td>
                        <td>
                            <form action={{route('User.destroy',["User"=>$User->id])}} method="post">
                                @csrf
                                @method("delete")
                                <input  type="hidden" name="tracking_code" value="{{$Order['id']}}">
                                <button class="btn btn-danger" type="submit"><i class="bi danger bi-file-earmark-excel-fill">delete</i></button>
                            </form>
                        </td>   
                        <td>
                            <form method="get" action={{route('User.edit',["User"=>$User->id])}}>
                                @csrf
                                <input  type="hidden" name="tracking_code" value="{{$Order['id']}}">
                                <button class="btn btn-success" type="submit"><i class="bi danger bi-file-earmark-excel-fill">edit</i></button>
                            </form>
                        </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
          @endif
    
    
          
          
    </div>

    
</div>

@endsection

@push('script')
<script>
    
    
</script>
@endpush