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
                    <th scope="col">How Many</th>
                    <th scope="col">See</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $count=1;
                    @endphp

                    @if(session()->get('one_user')==0)

                        @forelse ($Turn as $perTurn)
                        @php
                        $perUser=$Users->find($perTurn->user_id);
                        $checkColor=$perUser->threeMonth;
                        if($checkColor>5){
                            $color='green';
                        }elseif ($checkColor<=5 and $checkColor>2) {
                            $color='orange';
                        } else {
                            $color='red';
                        }
                        @endphp
                        <tr class="" style="color:{{$color}};"> >
                        <th scope="row">{{$count++}} </th>
                        <td>{{$perTurn->user->name}} </td>
                        <td>{{$perTurn->services->name}}</td>
                        <td>{{$perTurn->services->price}}</td>
                        <td>{{$perTurn->time}}</td>
                        <td>{{$perUser->threeMonth}}</td>
                        <td><a href="{{route('User.show',['User'=>$perUser->id])}} ">Lets see </a></td>
                        
                        </tr>
                            
                        @empty
                            
                        @endforelse
                    @else
                        @forelse ($User as $perTurn)
                        @php
                        $perUser=$Users->find($perTurn->user_id);
                        $checkColor=$perUser->threeMonth;
                        if($checkColor>5){
                            $color='green';
                        }elseif ($checkColor<=5 and $checkColor>2) {
                            $color='orange';
                        } else {
                            $color='red';
                        }
                        @endphp
                        <tr class="" style="color:{{$color}};"> >
                        <th scope="row">{{$count++}} </th>
                        <td>{{$perTurn->user->name}} </td>
                        <td>{{$perTurn->services->name}}</td>
                        <td>{{$perTurn->services->price}}</td>
                        <td>{{$perTurn->time}}</td>
                        <td>{{$perUser->threeMonth}}</td>
                        <td><a href="{{route('User.show',['User'=>$perUser->id])}} ">Lets see </a></td>
                        
                        </tr>
                            
                        @empty
                            
                        @endforelse

                    @endif
                </tbody>
              </table>
              {{ $Turn->links() }}
        </div>

        <div class="col">
             {{-- ---------------------User and service---------------------- --}}
        <div class="col p-2">
            <h3>Service</h3>
            <div class="d-flex flex-column m-2 ">
                <form action="/Admin/1/Search" method="post">
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
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="One_user" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">one user</label>
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
                <h3>Service</h3>
                <table class="table">
                <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Price</th>
                   <th scope="col">Time</th>
                   <th scope="col">description</th>
                   <th scope="col">ّFunction</th>
                   <th scope="col">ّ</th>
               </tr>
               </thead>
               <tbody>
                   @php
                       $count=1;
                   @endphp
                   <tr>

                       <form action="{{route('Service.store')}}" method="post">
                           @csrf
                        <th scope="row"> </th>
                            <td>
                                <div class="mb-3 mt-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input name="name" value="{{old('name')}} " type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>                            
                            </td>
                            <td>
                                <div class="mb-3 mt-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input name="price" value="{{old('price')}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                            </td>
                            <td>
                                <div class="mb-3 mt-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input type="text" name="time" value="{{old('time')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                            </td>
                            <td>
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <textarea type="" name="description" value="{{old('description')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                            </td>
                            <td class="">
                                <div class=" mt-4  w-100  d-flex justify-content-center align-items-center" >
                                    <button class="btn p" type="submit">Add</button>

                                </div>
                            </td>
                        
                        </form>
                    </tr>


                   @forelse ($Service as $per)
                   <tr>
                   <th scope="row">{{$count++}} </th>
                   <td>{{$per->name}} </td>
                   <td>{{$per->price}}</td>
                   <td>{{$per->time}}</td>
                   <td>{{$per->description}}</td>

                    <td>
                        <form action="{{route('Service.destroy',['Service'=>$per->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$per->id}}">
                            <button class="btn " type="submit">delete</button>
                        </form>
                    </td>

                    <td>
                     
                           
                            
                            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$per->id}}">edit</button>
                           
                      
                    </td>
                   
                   </tr>
                   <div class="modal  modal-dialog  modal-dialog-scrollable" id="staticBackdrop_{{$per->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('Service.update',['Service'=>$per->id])}}" method="post">
                            @csrf
                            @method('put')
                        <div class="modal-body">
                            <div>
                                <div class="mb-3 mt-3">
                                    <input type="hidden" name="id" value="{{$per->id}}">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input name="name" value="{{old('name')??$per->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>                            
                            
                                <div class="mb-3 mt-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input name="price" value="{{old('price')?? $per->price}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                            
                                <div class="mb-3 mt-3">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <input type="text" name="time" value="{{old('time')??$per->time}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                            
                                <div class="mb-3 ">
                                    <label for="exampleInputEmail1" class="form-label"></label>
                                    <textarea type="" name="description" value="{{old('description')??$per->description}}" placeholder="{{old('description')??$per->description}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
                                    <div id="emailHelp" class="form-text"></div>
                                </div> 
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button class="btn btn-success" type="submit">Edit </button>
                        </div>
                         </form>
                      </div>
                    </div>
                  </div>
                   @empty
                       
                   @endforelse
               
               </tbody>
           </table>
            </div>
   
         
    </div>
</div>


@endsection


