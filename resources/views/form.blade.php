@extends('layouts.app')

@section('content')
  
<div class="container">
    {{-- -------------------- worktime---------------------------- --}}
           
    <div class="col-9 "data-bs-spy="scroll" data-bs-smooth-scroll="true"  >
       
                 @csrf
             <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">day</th>
                     <th scope="col">start</th>
                     <th scope="col">end</th>
                     <th scope="col">capacity</th>
                     <th scope="col">Choose</th>
                     
                  
                   </tr>
                 </thead>
                 <tbody>
    
                     @php   $count=1; @endphp
                     @foreach ($Worktime as $time)
                         <tr>
                         <th scope="row">{{$count++}}</th>
                         <td>{{$time['day']}} </td>
                         <td>{{$time['start']}} </td>
                         <td>{{$time['end']}} </td>
                         <td>{{$time['capacity']}} </td>
                         <td>
                            <form action={{route('CreateTurn')}} method="post">
                                @csrf
                                <input type="hidden" name="services_id" value={{$Dates['services_id']}}>
                                <input type="hidden" name="user_id" value={{$Dates['user_id']}}>
                                <input type="hidden" name="worktime_id" value={{$time['id']}}>
                                <button class="btn btn-primary" type="submit">Choose</button>
                            </form>     
                        </td>
                         </tr>
                     @endforeach
    
                 </tbody>
               </table>
         
         </div>
    
     </div>
       
    </div>



@endsection