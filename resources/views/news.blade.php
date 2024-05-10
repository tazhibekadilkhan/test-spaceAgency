@extends('layouts.app')

@section('content')
    <div class="main news-page">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>Новости и события</li>
            </ul>
            <h1 class="title">Новости и события</h1>
            <div class="events-list">
                @foreach($news as $new)
                    <div class="events-item">
                        <div class="events-item-img">
                            <img src="{{ url('/storage/' . $new->image) }}" alt="">
                        </div>
                        <div class="events-item-caption">
                            <b>{{ $new->name }}</b>
                            <p>{!! $new->description !!}</p>
{{--                            <button class="btn-orange">Зарегистрироваться</button>--}}
                            <a href="/news/{{ $new->alias }}" class="btn-orange">Перейти</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links">
                {{ $news->links('pagination::bootstrap-4') }}
            </div>
{{--            <a href="#" class="btn-main news-page-btn">Перейти ко всем мероприятиям</a>--}}
        </div>
    </div>
@endsection

