@extends('layouts.app')

@section('content')
    <div class="main news-page">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>Список филиалов</li>
            </ul>
            <h1 class="title">Список филиалов</h1>
            <div class="events-list">
                @foreach($departments as $department)
                    <div class="events-item">
                        <div class="events-item-img">
                            <img src="{{ url('/storage/' . $department->image) }}" alt="">
                        </div>
                        <div class="events-item-caption">
                            <b>{{ $department->name }}</b>
                            <p>{!! $department->description !!}</p>
                            <a href="/departments/{{ $department->alias }}" class="btn-orange">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links">
                {{ $departments->links('pagination::bootstrap-4') }}
            </div>
{{--            <a href="#" class="btn-main news-page-btn">Перейти ко всем мероприятиям</a>--}}
        </div>
    </div>
@endsection

