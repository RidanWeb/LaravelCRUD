<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- <style>
        .table th, .table td {
          width: 33.33%; /* Forces each column to take up equal width */
        }
    </style> --}}
  </head>
  <body>

  <div class="bg-dark text-white text-center py-4">
    <h2>Laravel CRUD Project</h2>
  </div>

  <div class="student-form mt-4">
    <div class="container">
        <div class="row d-flex justify-content-center mb-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a class="btn btn-dark" href="{{ route('student.create') }}">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10">
                <div class="alert alert-success text-center mt-2" role="alert">
                    <h4>{{Session::get('success')}}</h4>
                </div>
            </div>
            @endif
        </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header bg-dark text-white text-center">
              <h3>Students List</h3>
            </div>
            <div class="card-body">
                <table class="table align-middle text-center">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Discription</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @if ($students -> isNotEmpty())
                            @foreach ($students as $student)
                                <tr>
                                    <th scope="row">{{$student -> id}}</th>
                                    <td>{{$student -> name}}</td>
                                    <td>{{$student -> email}}</td>
                                    <td>{{$student -> age}}</td>
                                    <td>{{$student -> description}}</td>
                                    <td>
                                        @if ($student -> image != '')
                                            <img width="50" height="50" class="rounded-circle" src="{{asset('uploads/students/'.$student -> image)}}" alt="No-Image">
                                        @endif
                                    </td>
                                    {{-- <td class="col">{{\Carbon\Carbon::parse($student -> created_at)->format('d M, Y')}}</td> --}}
                                    <td>{{\Carbon\Carbon::parse($student -> created_at)->timezone('Asia/Dhaka')->format('h:i:s A')}}</td>
                                    <td>
                                        <a href="{{route('student.edit', $student ->id)}}" class="btn btn-sm btn-dark">Edit</a>

                                        <a href="#" onclick="deleteProduct({{$student->id}})" class="btn btn-sm btn-danger">Delete</a>

                                        <form id="delete-student-from-{{$student ->id}}" action="{{route('student.destroy', $student->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <script>
        function deleteProduct(id){

            if(confirm("Are you sure you want to delete product?")){
                document.getElementById("delete-student-from-"+ id).submit();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
