{{-- @php
$photos = [
  [
    'id' => 1,
    'title' => 'La foto numero 1',
  ],
  [
    'id' => 2,
    'title' => 'La foto numero 2',
  ],
  [
    'id' => 3,
    'title' => 'La foto numero 3',
  ],
  [
    'id' => 4,
    'title' => 'La foto numero 4',
  ],
];
@endphp --}}
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Photos</li>
          </ol>
        </nav> 
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <h2>Photos</h2>
          </div>
          <div class="offset-3 col-3">
            <a href="{{route('admin.photos.create')}}">Carica una nuova foto</a>
          </div>
        </div>
        <table class="table">
          <thead class="thead-dark ">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($photos as $photo)
              <tr>
                <td>{{$photo['id']}}</td>
                <td>{{$photo['name']}}</td>
                
                <td><a class="btn btn-primary" href="">Visualizza</a> </td>
                <td><a class="btn btn-info" href="">Modifica</a></td>
                <td>
                  <form action="">
                    <input class="btn btn-danger" type="submit" value="Elimina">
                  </form>
                </td>
              </tr>
            @endforeach
         
          </tbody>
        </table>
      </div>
    </div>

  </div>
@endsection
