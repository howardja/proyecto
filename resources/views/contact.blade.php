@extends('app')
@section('estilo')
    <style>
        .setWidth {
            max-width: 900px;
        }
        .concat div { overflow: auto;
            -ms-text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            white-space: normal;
            width: inherit;
            height: 40px;
            padding-right: 25px;;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <h1>TODOS LOS POSTS</h1>
                    <h2>total de post {{App\User::find(Auth::id())->posts->count()}}</h2>
                    <h2>siguinedo {{App\User::find(Auth::id())->idols->count()}}</h2>
                    <h2>siguinedo {{App\Idol::all()->count()}}</h2

                                        {!! Form::open(['url'=>'siguiendo']) !!}
                                        {!! Form::hidden('user_id', Auth::id()) !!}
                                        {!! Form::submit('Siguiendo',['class' => 'btn btn-primary active']) !!}
                                        {!! Form::close() !!}

                    <div class="panel-body">


                        {!! Form::open(array('route' => 'posts.store', 'method'=>'post')) !!}
                            {!! Form::hidden('user_id',  Auth::id()) !!}
                            <div class="form-group">
                                {!! Form::textarea('texto',null, ['class'=>'form-control', 'maxlength'=>140, 'rows'=>2]) !!}
                            </div>
                            <button type="submit" class="btn btn-info">Postear</button>
                        {!! Form::close() !!}

                        <table class="table-striped table-hover">
                            <tbody>
                            @foreach(App\User::find(Auth::id())->posts as $post)

                                <tr>
                                    <th>{{$post->created_at}}</th>
                                </tr>
                                <tr>
                                    <td class="setWidth concat" ><div>{{$post->texto}}</div></td>
                                </tr>
                                <tr>
                                    <td>Likes: {{$post->likes->count()}}</td>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::open(['url'=>'likes']) !!}
                                        {!! Form::hidden('post_id', $post->id) !!}
                                        {!! Form::submit('Me gusta',['class' => 'btn btn-primary active']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><hr/></td>
                                </tr>
                            @endforeach

                            @foreach(App\User::find(Auth::id())->idols as $idolo)
                                @foreach(App\User::find($idolo->idol_id)->posts as $post)

                                    <tr>
                                        <th>{{$post->created_at}}</th>
                                    </tr>
                                    <tr>
                                        <td class="setWidth concat" ><div>{{$post->texto}}</div></td>
                                    </tr>
                                    <tr>
                                        <td>Likes: {{$post->likes->count()}}</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::open(['url'=>'likes']) !!}
                                            {!! Form::hidden('post_id', $post->id) !!}
                                            {!! Form::submit('Me gusta',['class' => 'btn btn-primary active']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><hr/></td>
                                    </tr>
                                @endforeach

                            @endforeach


                            </tbody>
                        </table>


                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

    

