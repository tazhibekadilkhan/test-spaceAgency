@extends('layouts.app')

@section('content')
    <div class="main news-page">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/news">Список филиалов</a>
                </li>
                <li>{{ $department->name }}</li>
            </ul>
            <div class="article">
                <h1 class="title-lg">{{ $department->name }}</h1>
                <div class="article-img">
                    <img src="{{ url('/storage/' . $department->image) }}" alt="">
                </div>
                <div class="article-text" contenteditable="true">{!! $department->content !!}</div>
{{--                <a href="#" class="btn-orange" data-bs-toggle="modal"--}}
{{--                   data-bs-target="#feedbackModal">Зарегистрироваться</a>--}}
            </div>

            @if(count($kindergartens) > 0)
                <div class="similar">
                    <div class="similar-top">
                        <h2 class="title">Садик</h2>
                    </div>
                    <div class="similar-list">
                        @foreach($kindergartens as $kindergarten)
                            <div class="similar-item">
                                <div class="similar-item-img">
                                    <img src="{{ url('/storage/' . $kindergarten->image) }}" alt="">
                                </div>
                                <div class="similar-item-caption">
                                    <h6>{{ $kindergarten->name }}</h6>
                                    <p>{{ $kindergarten->description }}</p>
                                </div>
                                {{--                            <a href="/departments/{{ $dNew->alias }}" class="absolute-link"></a>--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @include('components.partners')
        </div>
    </div>
@endsection
