/**********************************************
THIS IS NO LONGER USED. events.addStudents.blade.php
*********************************************/

@extends('layouts.app') 
@section('content')
<div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary small">Back</a>
    <h1>
       Adding students to event {{$event->name}}
    </h1>
    
    <div class="card card-primary">
        <div class="card-body">
        @if (session('error'))
        <div class="alert alert-error" role="alert">
            {{ session('error') }}
            <br>
            <p class="small">Change this to a popup message that then disappears</p>
        </div>
        @endif


            <p>Enter a course code, no spaces, no hyphen. e.g. ATC10102</p>
            <form role="form" action="/events/addStudents" method="post">                                        
                <input type="hidden" id="eventID" name="eventID" value="{{$event->id}}">
                
                <div class="form-group">
                   
                        <div class="input-group">
                            {{--  <a href="#" data-toggle="tooltip" title="" data-original-title="Default tooltip">you probably</a>  --}}
                            <label class="input-group-prepend btn btn-success" for="name">Course code </label>                            
                            <input type="text" class="form-control mx-1 col-2 border border-success" id="courseCode" name="courseCode" required autofocus>
                        </div>                
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-body">
            @if($studentList->count())
                <p>Students attached to this event</p>
            
                <p>
                @foreach($studentList as $SL)            
                        {{$SL->student_id}} : {{$SL->student->firstname}} {{$SL->student->lastname}}<br/>        
                @endforeach 
                </p>
            @endif
        </div>
    </div>

</div>
@endsection
