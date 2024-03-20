<!DOCTYPE html>
<html lang="en">
@include('components.header', ['title' =>  (isset($user) ? 'Edit User' : 'Create User' )])
    <body class="sb-nav-fixed">
@include('components.navbar')

        <div id="layoutSidenav">
          @include('components.sidebar', ['title' => 'Create User'])
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>


                        <div class="row mx-auto">

<div class="col-md-12 my-4">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(isset($user)) 

<form method="post" action="{{ route('user.update', $user->id) }}">
@method('PUT')

@else

<form action="{{route("user.store")}}" method="post">

@endif
@csrf
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" class="form-control" value="{{ isset($user) ? $user->name : '' }}"  name='name'>
  </div>

  <div class="mb-3">
    <label  class="form-label">Email address</label>
    <input type="email" name='email' value="{{ isset($user) ? $user->email : '' }}" class="form-control" >
  </div>

  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password"  name='password' class="form-control" >
  </div>


  <div class="mb-3">
  <label  class="form-label">Role</label>
  <select class="form-select"  name="role_id">
  <option selected disabled value="" hidden>Select</option>
  <option value="1" {{ (isset($user) && $user->role_id == 1) ? 'selected' : '' }}>Admin</option>
        <option value="2" {{ (isset($user) && $user->role_id == 2) ? 'selected' : '' }}>Sub Admin</option>
        <option value="3" {{ (isset($user) && $user->role_id == 3) ? 'selected' : '' }}>User</option>
        <option value="4" {{ (isset($user) && $user->role_id == 4) ? 'selected' : '' }}>Sub User</option>

</select>
</div>



  @if(isset($user))
        @method('PUT')
        <button type="submit" class="btn btn-primary">Update</button>
    @else
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif

</form>
</div>

                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User Data
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created Since</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ucfirst(trans($user->name))}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role_id}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                            <td class="text-center">
                                                <!-- <a class="btn btn-primary " href="#">View</a> -->
                                                <a class="btn btn-success " href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                <a class="btn btn-danger " href="{{ route('user.destroy', $user->id) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">Delete</a>

                                                <form id="delete-form" style="display:none;" method="POST" class="fm-inline"
                            action="{{ route('user.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-primary"/>
                        </form>
                                        </td>
                                         
                                        </tr>
                                        @endforeach
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                @include('components.footer')

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
    </body>
</html>
