<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

  <div class="bg-dark text-white text-center py-4">
    <h2>Laravel CRUD Project</h2>
  </div>

  <div class="student-form mt-4">
    <div class="container">
        <div class="row d-flex justify-content-center mb-4">
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-dark" href="{{ route('student.index') }}">Students</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                <h3>Edit Student</h3>
                </div>
                <div class="card-body">
                <form enctype="multipart/form-data" action="{{route('student.update', $student->id)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Enter your name :</label>
                    <input value="{{old('name', $student->name)}}" type="text" class="@error('name') is-invalid @enderror form-control" id="exampleInputName" aria-describedby="emailHelp" name="name">
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Enter your email :</label>
                    <input value="{{old('email', $student->email)}}" type="email" class="@error('name') is-invalid @enderror form-control" id="exampleInputEmail" name="email">
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputAge" class="form-label">Enter your age :</label>
                    <input value="{{old('age', $student->age)}}" type="number" class="@error('age') is-invalid @enderror form-control" id="exampleInputAge" name="age">
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputDisc" class="form-label">Enter your discription :</label>
                    <textarea class="form-control" id="exampleInputDisc" rows="3" name="description">{{old('description', $student->description)}}</textarea>
                    </div>
                    <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Enter your image</label>
                    <input value="{{old('image', $student->image)}}" class="form-control" type="file" id="formFileMultiple" multiple  name="image">
                    @if ($student -> image != '')
                        <img width="50" height="50" class="rounded-circle" src="{{asset('uploads/students/'.$student -> image)}}" alt="No-Image">
                    @endif
                    </div>
                    <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
  </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
