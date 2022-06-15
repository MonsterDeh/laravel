@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="row">
            {{-- ---------------------User and service---------------------- --}}
        <div class="col">
            <h3>User and service</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Service</th>
                    <th scope="col">Price</th>
                    <th scope="col">Time</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $count=1;
                    @endphp
                    @forelse ($Turn as $perTurn)
                    <tr>
                      <th scope="row">{{$count++}} </th>
                      <td>{{$perTurn->user->name}} </td>
                      <td>{{$perTurn->services->name}}</td>
                      <td>{{$perTurn->services->price}}</td>
                      <td>{{$perTurn->worktime->time}}</td>
                      
                    </tr>
                        
                    @empty
                        
                    @endforelse
                 
                </tbody>
              </table>

        </div>

        <div class="col">
             {{-- ---------------------User and service---------------------- --}}
        <div class="col p-2">
            <h3>Service</h3>
            <div class="d-flex flex-column m-2 ">
                <form action="Admin/1/Search" method="post">
                    @csrf
                    <div class="d-flex flex-column ">
                        <div class="d-flex flex-row p-4 justify-content-center">
                            <div class="w-50">   
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="Search_status" value="y" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Thay are done
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="Search_status" value="n" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              Thay are not done
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="Search_status" value="all" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              All
                            </label>
                          </div>
                        </div>
                        <div class="w-50">
                            <label for="exampleFormControlInput1" class="form-label">Date Search</label>
                            <input type="date" name="Search_date" class="form-control" id="exampleFormControlInput1" placeholder="date Search">
                        </div>
                    </div>
                    <div class="align-self-center">
                        <button class="btn btn-success"> Search</button>
                    </div>
                </div>
                </form>
                    <div>

                    <table class="table">
                        <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Time</th>
                        <th scope="col">description</th>
                        <th scope="col">How Many</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $count=1;
                        @endphp
                    
                        @forelse ($Service as $per)
                        <tr>
                        <th scope="row">{{$count++}} </th>
                        <td>{{$per->name}} </td>
                        <td>{{$per->price}}</td>
                        <td>{{$per->time}}</td>
                        <td>{{$per->description}}</td>
                        <td>{{$per->turn_count}}</td>
                        
                        </tr>
                            
                        @empty
                            
                        @endforelse
                    
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        
        

    </div>
    <div class="col-12 ">
            <div class="w-100">
                <h3>Users</h3>
               <table class="table">
                   <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Price</th>
                   <th scope="col">Time</th>
                   <th scope="col">description</th>
                   <th scope="col">How Many</th>
               </tr>
               </thead>
               <tbody>
                   @php
                       $count=1;
                   @endphp
               
                   @forelse ($Service as $per)
                   <tr>
                   <th scope="row">{{$count++}} </th>
                   <td>{{$per->name}} </td>
                   <td>{{$per->price}}</td>
                   <td>{{$per->time}}</td>
                   <td>{{$per->description}}</td>
                   <td>{{$per->turn_count}}</td>
                   
                   </tr>
                       
                   @empty
                       
                   @endforelse
               
               </tbody>
           </table>
            </div>
   
         
    </div>
</div>


@endsection


