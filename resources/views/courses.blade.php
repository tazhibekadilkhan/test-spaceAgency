@extends('layouts.app')

@section('content')
    <div class="main news-page">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>Профессиональное развитие и обучение</li>
            </ul>
            <h1 class="title">Профессиональное развитие и обучение</h1>
            <div class="events-list">
                @foreach($courses as $course)
                    <div class="events-item">
                        <div class="events-item-img">
                            <img src="{{ url('/storage/' . $course->image) }}" alt="">
                        </div>
                        <div class="events-item-caption">
                            <b>{{ $course->name }}</b>
                            <p>{!! $course->description !!}</p>
                            @if($course->link)
                                <a href="{{ $course->link }}" target="_blank" class="btn-orange">Открыть</a>
                            @else
                                <a href="/courses/{{ $course->alias }}" class="btn-orange">Подробнее</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links">
                {{ $courses->links('pagination::bootstrap-4') }}
            </div>
{{--            <a href="#" class="btn-main news-page-btn">Перейти ко всем мероприятиям</a>--}}
        </div>
    </div>
@endsection

