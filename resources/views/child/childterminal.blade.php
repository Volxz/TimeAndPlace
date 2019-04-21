<table class="pure-table pure-table-bordered table-canvas" style="border:none;">
   <thead>
      <tr>
         <th>Student Name</th>
         <th>Student Number</th>
      </tr>
   </thead>
   <tbody>

      @foreach ($students as $student)
      <tr>
         <td onclick="getOneStudent({{$student->studentID}})">{{$student->lastname }}, {{$student->firstname}}</a></td>
         <td onclick="getOneStudent({{$student->studentID}})"><a href="">{{$student->studentID}}</a></td>
      </tr>
      @endforeach

   </tbody>
</table>