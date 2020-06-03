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

$page = [
  'id' => 1,
  'title' => 'Earth’s first oﬀ-world colonies will be built on soil',
  'summary' => 'As Apollo astronauts trundled and trod awkwardly across the desolate lunar landscape, an insidious menace scuffed up their spacesuits.',
  'body' => "Moondust. Fine as talcum powder, sharp as glass and seemingly everywhere, these super-fine particles coated the astronauts like soot and permeated their crew cabin, where it became more than a mere nuisance. Not only did it interfere with their equipment, it irritated their nostrils and eyes, giving some a mild allergic reaction.
             Nevertheless, between 1969 and 1972, Apollo astronauts brought back nearly 385 kilograms of lunar rock, pebbles and powder back to earth. Moondust deserved further study.
            Today, NASA deems interplanetary dust and dirt — also known as regolith — one of the greatest risks to long-term space settlements. On Mars, it’s toxic and magnetic. On the Moon, it wears away at multi-million-dollar instruments and lodges into the slightest crevasses, weakening seals on pressure suits and causing hardware to malfunction. But for all its difficulties, regolith holds astronomical potential, too. It’s considered key to sustainable space exploration and will likely form the foundation — and the roofs, walls and infrastructure––of society's first off-Earth settlements.",
  'category_id' => 2,
  'tags' => [
    1,
    4,
    7
  ],
  'photos' => [
    2
  ]
];

$oldtags = null;
$message = '';

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
              <li class="breadcrumb-item active" aria-current="page">Edit Page {{$page['id']}}</li>
            </ol>
          </nav>
        </div>
      </div>
    
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <h2>Modifica la pagina</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form action="" method="POST">
              @csrf
              @method("PUT")
              <div class="form-group pt-3">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" value="{{$page['title']}}">
                @error('title')
                  <small class="form-text">Errore nell'inserimento del titolo.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <label for="summary">Summary</label>
                <input type="text" class="form-control" id="summary" value="{{$page['summary']}}">
                @error('summary')
                  <small class="form-text">Errore nell'inserimento del sommario.</small>
                @enderror
              </div>
              <div class="form-group col-4 pl-0 pt-3">
                <label for="category">Category</label>
                <select name="category" id="category" class="custom-select">
                  @foreach ($categories as $category)
                    @if ($category['id'] == $page['category_id'])
                      <option name="category" value="{{$category['id']}}" selected>{{$category['name']}}</option>
                    @else
                      <option name="category" value="{{$category['id']}}">{{$category['name']}}</option>
                    @endif
                  @endforeach
                </select>
                @error('category')
                    <small class="form-text">Errore nella scelta della categoria.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <label for="body">Body</label>
                <textarea class="d-block col-12" name="body" id="body" rows=10>{{$page['body']}}</textarea>
                @error('body')
                    <small class="form-text">Errore nell'inserimento del body.</small>
                @enderror
              </div>
              <div class="form-group pt-3">
                <fieldset>
                  <label class="d-block">Tags</label>
                  @foreach ($tags as $tag)
                      <div class="form-check form-check-inline">
                      @if(is_array($oldtags))
                        <input class="form-check-input"  type="checkbox" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}"  
                        {{ 
                          (in_array($tag['id'],  $oldtags))
                        
                          ? 'checked' : ''
                        }}
                        >
                      @else 
                      <input class="form-check-input"  type="checkbox" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}"  
                        {{ 
                          (in_array($tag['id'],  $page['tags']))
                        
                          ? 'checked' : ''
                        }}
                         >
                      @endif
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
                        <input type="checkbox" class="form-check-input" name="photos[]" id="photo{{$photo['id']}}" 
                        value="{{$photo['id']}}" {{in_array($photo['id'], $page['photos']) == true ? 'checked' : ''}}>
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
                <input class="btn btn-primary" type="submit" value="Salva le modifiche">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> 

@endsection