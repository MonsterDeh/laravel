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
                    <input type="date" value="{{old('date')}}" name="day" class="form-control" id="exampleFormControlInput1" required placeholder="date Search">
                </div>
                <div>
                    <input type="time" value="{{old('time')}}" class="form-control w-25" id="appt" name="Hour" min="09:00" max="21:00" required>
                </div>
             
                   
                
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
        @if (session()->has('success'))
        <div class="alert h3 alert-success"> {{session('success')}}</div>  
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
                    <th scope="col">Type Services</th>
                    <th scope="col">Delete</th>
                    <th scope="col">edit</th>
                
                <?php   ?>
                </tr>
                </thead>
                <tbody>

                    @php   $count=1; @endphp
                    @foreach ($Orders as $Order)
                        <tr>
                        <th scope="row">{{$count}}</th>
                        <td>{{$Order['tracking_code']}} </td>
                        <td>{{$Order['date']}} </td>
                        <td>{{$Order['start'].'-'.$Order['end']}} </td>
                        <td>{{$Order->services->first()->name}} </td>
                      
                        <td>
                            <form action={{route('User.destroy',["User"=>$User->id])}} method="post">
                                @csrf
                                @method("delete")
                                <input  type="hidden" name="tracking_code" value="{{$Order['tracking_code']}}">
                                <button class="btn btn-danger" type="submit"><i class="bi danger bi-file-earmark-excel-fill">delete</i></button>
                            </form>
                        </td>   
                        <td>
                            

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$count}}">
                                Eite
                            </button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop_{{$count }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    Date: {{$Order['date']}} 
                                    Time: {{$Order['start'].'-'.$Order['end']}} 
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="get" action={{route('User.edit',["User"=>$User->id])}}>
                                    @csrf
                                <div class="modal-body">
                                        <input  type="hidden" name="tracking_code" value="{{$Order['tracking_code']}}" >
                                        <div class="d-flex justify-content-around" >
                                            <div class="">
                                                <input type="date" value="" name="day" class="form-control" id="exampleFormControlInput1" required placeholder="date Search">
                                            </div>
                                            <div>
                                                <input type="time" value="" class="form-control " id="appt" name="Hour" min="09:00" max="21:00" required>
                                            </div>
                                          
                                                <select id="ServiceSelect" name="service" class="form-select  form-select-sm w-25" aria-label="Default select example">
                                                    @forelse ($Services as $service)
                                                    <option value={{$service['id']}} >{{$service['name']}} </option>
                                                    @empty
                                                        <p>bug</p>
                                                    @endforelse
                                                    
                                                  </select>
                                            
                                           
                                        </div>
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-success" type="submit">
                                            <i class="bi danger bi-file-earmark-excel-fill">edit</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        

                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach

                </tbody>
            </table>
          @endif
    
    
          
          
    </div>

    
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
    
    
</script>
@endpush