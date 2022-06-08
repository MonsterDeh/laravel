@extends('layouts.app')

@section('content')
    
<div class="container">
    <div>
        
             {{-- -------------------- day---------------------------- --}}
            

            
        <div class="py-4 row " name='time' onchange="showUser(this.value)">
            <div class="col-3" >
                
                <form action= method="get" onsubmit="setTimeout(function () { window.location.reload(); }, 2)"> 
                    @csrf
                <select onchange="this.form.submit()" name="day" class="form-select" multiple aria-label="multiple select example">
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                
                </select>
            </form>
            </div>
       {{-- -------------------- worktime---------------------------- --}}
       
       <div class="col-9 "data-bs-spy="scroll" data-bs-smooth-scroll="true"  >
           <form action="">
                    @csrf
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">day</th>
                        <th scope="col">start</th>
                        <th scope="col">end</th>
                        <th scope="col">capacity</th>
                       <?php //TODO ADD function for delete update   ?>
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
                            </tr>
                        @endforeach

                    </tbody>
                  </table>
                </form>
            </div>

        </div>
       {{-- -------------------- Sercice---------------------------- --}}
        <div class="d-flex  py-4 justify-content-center">
            <label class="p-1" for="ServiceSelect">Service</label>
            <select id="ServiceSelect" name="service" class="form-select w-25" aria-label="Default select example">
                @forelse ($Services as $service)
                <option value={{$service['id']}} >{{$service['name']}} </option>
                @empty
                    <p>bug</p>
                @endforelse
                
              </select>
        </div>
            {{-- -------------------- ---------------------------- --}}
        <div class="d-flex  py-4 justify-content-center">
            <button class="btn btn-success" type="submit">Submint</button>
        </div>
        
    </div>
</div>

@endsection

@push('script')
<script>
    
    
</script>
@endpush