@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="poster" id="about">
            <div class="container">
                <div class="poster-caption">
                    <h1>Ассоциация дошкольных образовательных организаций и педагогов</h1>
                    <p>Слоган: переход дошкольного образования на новый уровень через объединение науки и практики</p>
                    <button class="btn-main">Узнать больше</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section mission">
                <div class="mission-img">
                    <img src="{{ asset('images/main/mission-img.png') }}" alt="">
                </div>
                <div class="mission-caption">
                    <h2 class="title">Наша миссия:</h2>
                    <p>Мы содействуем качественному дошкольному образованию в Республике Казахстан, объединяя науку и
                        практику. Наши усилия направлены на то, чтобы научные исследования стали основой для разработки
                        передовых методик и подходов, которые затем успешно внедряются в практике дошкольных учреждений.
                        Мы стремимся обеспечить детей Республики Казахстан доступом к передовым знаниям и методам,
                        обеспечивая им лучшие возможности для развития и подготовки к будущей жизни."</p>
                    <button class="btn-main">Подробнее о нас</button>
                </div>
            </div>
            <div class="section activities" id="activities">
                <h2 class="title">Направления</h2>
                <div class="swiper activities-slider">
                    <div class="swiper-wrapper">
                        @foreach($directions as $direction)
                            <div class="swiper-slide activities-item">
                                <img src="{{ url('/storage/' . $direction->icon )}}" alt="">
                                <h6>{{ $direction->name }}</h6>
                                <p>{{ $direction->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="section news" id="news">
                <h2 class="title">Новости и события</h2>
                <div class="news-content">
                    <div class="main-news">
                        <div class="main-news-img">
                            <img src="{{ url('/storage/' . $mainNews->image) }}" alt="">
                            <span class="main-news-date">{{ $mainNews->created_at->format('d.m.Y') }}</span>
                        </div>
                        <div class="main-news-caption">
                            <h5>{{ $mainNews->name }}</h5>
                            <p>{{ $mainNews->description }}</p>
                        </div>

                        <a href="/news/{{ $mainNews->alias }}" class="absolute-link"></a>
                    </div>
                    <div class="news-list-wrapper">
                        <div class="news-list">
                            @foreach($news as $new)
                                <div class="news-item">
                                    <span class="news-item-date">{{ $new->created_at->format('d.m.Y') }}</span>
                                    <p class="news-item-content">{{ $new->name }}</p>
                                    <a href="/news/{{ $new->alias }}" class="absolute-link"></a>
                                </div>
                            @endforeach
                        </div>
                        <a class="btn-main" href="/news">Перейти ко всем новостям</a>
                    </div>
                </div>
            </div>
            <div class="section events">
                <h2 class="title">Профессиональное развитие и обучение</h2>
                <div class="events-list">
                    @foreach($courses as $course)
                        <div class="events-item">
                            <div class="events-item-img">
                                <img src="{{ url('/storage/' . $course->image) }}" alt="">
                            </div>
                            <div class="events-item-caption">
                                <b>{{ $course->name }}</b>
                                <p>{{ $course->description }}</p>
                                @if($course->link)
                                    <a href="{{ $course->link }}" target="_blank" class="btn-orange">Открыть</a>
                                @else
                                    <a href="/courses/{{ $course->alias }}" class="btn-orange">Подробнее</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="/courses" class="btn-main">Перейти ко всем мероприятиям</a>
            </div>
            <div class="section inform" id="inform">
                <h2 class="title">Список филиалов</h2>
                <div class="inform-list">
                    @foreach($departments as $department)
                        <div class="inform-item">
                            <b>{{ $department->name }}</b>
                            <p>{{ $department->description }}</p>
                            <a href="/departments/{{ $department->alias }}" class="btn-orange">Подробнее</a>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('components.partners')
        </div>
    </div>
@endsection
