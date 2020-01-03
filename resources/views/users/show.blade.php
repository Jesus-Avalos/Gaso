@extends('layouts.app')

@section('main-content')

    <div class="container">
       @if(Session::has('status'))
          <div class="alert alert-success" id="alertSuccess" role="alert">
              {{Session::get('status')}}
          </div>
      @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Profile') }}</div>

                    <div class="card-body">
                        <table class="table table-condensed table-hovered">
                            <tr>
                              <th>Name</th>
                              <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>{{ $user->email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
