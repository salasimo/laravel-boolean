@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.photos.index')}}">Photos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <form action="{{route('admin.photos.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="name" placeholder="Inserisci il titolo della foto" name="name">
            @error('title')
              <small class="form-text">Errore</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description"  placeholder="Inserisci la descrizione"  name="description">
            @error('description')
              <small class="form-text">Errore</small>
            @enderror
          </div>
          <div class="form-group col-6 pl-0">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01" name="path">
              <label class="custom-file-label" for="inputGroupFile01">Carica una foto</label>
            </div>
            @error('path')
              <small class="form-text">Errore</small>
            @enderror
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Salva">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection