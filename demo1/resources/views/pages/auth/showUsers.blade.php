@extends('layout.master3')

@section('content')

<style>
   label{
       background-image: linear-gradient(to left, #1e3c72, #2a5298);
       color: transparent;
       background-clip: text;
       -webkit-background-clip: text;
       font-size: 17px;
   }

   h5{

       font-size: 40px;
       font-weight: 100;
       background-image: linear-gradient(to left, #553c9a, #b393d3);
       color: transparent;
       background-clip: text;
       -webkit-background-clip: text;
       margin-left: 100px;

   }

</style>
    <div>
        <form class="search-form" action="{{ route('searchUser') }}" method="post" style="margin-top: -70px;margin-bottom: 30px">
            @csrf
            <div class="row">
                <div class="input-group">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                    <input name="id" type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                </div>
            </div>
        </form>
    </div>

    <div>
        @if (session('success'))
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

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    @if ($users->isEmpty())
        <p>No users found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="d-flex align-items">
                                <div style="margin-right: 5px;">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $user->id }}">
                                        Update
                                    </button>
                                </div>
                                <div>
                                    <form action="{{ route('deleteUser',['id'=>$user->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="updateModal-{{ $user->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="token" class="form-label"style="
                                            ">Token</label>
                                            <input type="text" class="form-control" name="token" required>
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary"
                                        style="width: 300px;
                                               margin-left: 70px;
                                        "
                                        >Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
