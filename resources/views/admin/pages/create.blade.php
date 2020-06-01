@php
$categories = [
    [
        'id'=> 1,
        'name' => 'New Economy'

    ],
    [
        'id'=> 2,
        'name' => 'Space Exploration'

    ],
    [
        'id'=> 3,
        'name' => 'Start Up'

    ],
    [
        'id'=> 4,
        'name' => 'Tech Trends'

    ],
    [
        'id'=> 5,
        'name' => 'Mobility'

    ],

];

$tags = [
          [
            'id' => 1,
            'name' => 'Tag 1'
          ],
          [
            'id' => 2,
            'name' => 'Tag 2'
          ],
          [
            'id' => 3,
            'name' => 'Tag 3'
          ],
          [
            'id' => 4,
            'name' => 'Tag 4'
          ],
          [
            'id' => 5,
            'name' => 'Tag 5'
          ],
          [
            'id' => 6,
            'name' => 'Tag 6'
          ],
          [
            'id' => 7,
            'name' => 'Tag 7'
          ],
];

$photos = [
  [
    'id' => 1,
    'title' => 'Immagine natura',
    'path' => 'https://picsum.photos/id/116/80'
  ],
    [
      'id' => 2,
      'title' => 'Immagine luci',
      'path' => 'https://picsum.photos/id/223/80'
  ],
    [
      'id' => 3,
      'title' => 'Immagine miele',
      'path' => 'https://picsum.photos/id/312/80'
  ],
];


@endphp

@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.pages.index')}}">Pages</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
          </nav>
        </div>
      </div>
    
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <h2>Inserisci una nuova pagina</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form action="" method="POST">
              @csrf
              @method("POST")
              <div class="form-group pt-3">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" placeholder="Inserisci il titolo">
                @error('title')
                  <small class="form-text">Errore nell'inserimento del titolo.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <label for="summary">Summary</label>
                <input type="text" class="form-control" id="summary" placeholder="Inserisci il sommario">
                @error('summary')
                  <small class="form-text">Errore nell'inserimento del sommario.</small>
                @enderror
              </div>
              <div class="form-group col-4 pl-0 pt-3">
                <label for="category">Category</label>
                <select name="category" id="category" class="custom-select">
                  @foreach ($categories as $category)
                      <option value="{{$category['id']}}">{{$category['name']}}</option>
                  @endforeach
                </select>
                @error('category')
                    <small class="form-text">Errore nella scelta della categoria.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <label for="body">Body</label>
                <textarea class="d-block col-12" name="body" id="body" rows=10></textarea>
                @error('body')
                    <small class="form-text">Errore nell'inserimento del body.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <fieldset>
                  <label class="d-block">Tags</label>
                  @foreach ($tags as $tag)
                      <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}">
                        <label class="form-check-label" for="tag{{$tag['id']}}">{{$tag['name']}}</label>
                      </div>
                  @endforeach
                  @error('tags')
                    <small class="form-text">Errore nella selezione dei tag.</small>
                  @enderror
                </fieldset>
              </div>
              <div class="form-group pt-3">
                <fieldset>
                  <label class="d-block">Photos</label>
                  @foreach ($photos as $photo)
                      <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}">
                        <label class="form-check-label" for="photo{{$photo['id']}}">{{$photo['title']}}
                          <img class="p-3" src="{{$photo['path']}}" alt="{{$photo['title']}}">
                        </label>
                      </div>
                  @endforeach
                  @error('photos')
                    <small class="form-text">Errore nella selezione delle immagini.</small>
                  @enderror
                </fieldset>
              </div>
              <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Salva">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> 

@endsection