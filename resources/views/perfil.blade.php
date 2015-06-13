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

<div class="fondoguest">
</div>
@foreach ($users as $user)
    {{--{{$user->username}}--}}
@endforeach
{{--@stop--}}
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    @if($user->id != Auth::id() && Auth::check())
                        @include('partials.seguir')
                    @endif

                     <div class="panel-heading"><h1>Bienvenido a la pagina de {{$user->name}}</h1></div>

                    <div class="panel-body">
                        @if(Auth::check())
                            {!! Form::open(array('route' => 'posts.store', 'method'=>'post')) !!}
                            {!! Form::hidden('user_id',  Auth::id()) !!}
                            <div class="form-group">
                                {!! Form::textarea('texto',null, ['class'=>'form-control', 'maxlength'=>140, 'rows'=>2]) !!}
                            </div>
                            <button type="submit" class="btn btn-success">Postear</button>
                            {!! Form::close() !!}
                        @endif

                        <h2>Posts</h2>

                        <table class="table-striped table-hover">
                            <tbody>
                                @foreach(App\User::find($user->id)->posts as $post)
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
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
