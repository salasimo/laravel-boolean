{{-- @php
$pages = [
    [
        'id' => 1,
        'title' => 'Earth’s first oﬀ-world colonies will be built on soil',
        'category' => 2,
        'tags' => [
            1,
            4,
            7
        ]
    ],
    [
        'id' => 2,
        'title' => 'The Morning After: SpaceX makes history',
        'category' => 2,
        'tags' => [
            2,
            4,
            9,
            10
        ]
    ],
    [
        'id' => 3,
        'title' => 'Uber sends thousands of Jump e-bikes to the recycling heap',
        'category' => 5,
        'tags' => [
            1,
            2,
            5
        ]
    ]
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
                        <li class="breadcrumb-item active" aria-current="page">Pages</li>
                    </ol>
                </nav> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <h2>Pages</h2>
                    </div>
                    <div class="offset-3 col-3">
                        <a href="{{route('admin.pages.create')}}">Nuova pagina</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <td>{{$page['id']}}</td>
                                <td>{{$page['title']}}</td>
                                <td>{{$page['category']}}</td>
                                <td>
                                    @foreach ($page['tags'] as $tag)
                                        {{$tag}}
                                        @if (!$loop->last)
                                            | 
                                        @endif
                                    @endforeach
                                </td>
                                <td><a class="btn btn-primary" href="">Visualizza</a> </td>
                                <td><a class="btn btn-dark" href="">Modifica</a></td>
                                <td>
                                    <form action="">
                                        <input type="submit" value="Elimina" class="btn btn-danger">
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