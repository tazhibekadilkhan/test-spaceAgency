@extends('layouts.app')

@section('content')
    <div class="main news-page">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/news">Новости и события</a>
                </li>
                <li>{{ $new->name }}</li>
            </ul>
            <div class="article">
                <h1 class="title-lg">{{ $new->name }}</h1>
                <div class="article-img">
                    <img src="{{ url('/storage/' . $new->image) }}" alt="">
                </div>
                <div class="article-text" contenteditable="true">{!! $new->content !!}</div>
{{--                <a href="#" class="btn-orange" data-bs-toggle="modal"--}}
{{--                   data-bs-target="#feedbackModal">Зарегистрироваться</a>--}}
            </div>
            {{--<div class="review">
                <div class="review-write">
                    <div class="review-write-img">
                        <img src="img/main/news.png" alt="">
                    </div>
                    <div class="review-write-form">
                        <textarea rows="5" placeholder="Напишите свой комментарий здесь"></textarea>
                        <button class="btn-main">Оставить комментарий</button>
                    </div>
                </div>
                <div class="review-list">
                    <div class="review-item">
                        <div class="review-item-img">
                            <img src="img/main/news.png" alt="">
                        </div>
                        <div class="review-item-content">
                            <div class="review-item-content-top">
                                <b>Floyd Miles</b>
                                <span>2 дня назад</span>
                            </div>
                            <div class="review-item-content-text">Leverage agile frameworks to provide a robust synopsis
                                for high level overviews. Iterative approaches to corporate strategy foster
                                collaborative thinking to further the overall value proposition. Organically grow the
                                holistic world view of disruptive innovation via workplace diversity and empowerment.
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <div class="review-item-img">
                            <img src="img/main/news.png" alt="">
                        </div>
                        <div class="review-item-content">
                            <div class="review-item-content-top">
                                <b>Floyd Miles</b>
                                <span>2 дня назад</span>
                            </div>
                            <div class="review-item-content-text">Leverage agile frameworks to provide a robust synopsis
                                for high level overviews. Iterative approaches to corporate strategy foster
                                collaborative thinking to further the overall value proposition. Organically grow the
                                holistic world view of disruptive innovation via workplace diversity and empowerment.
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <div class="review-item-img">
                            <img src="img/main/news.png" alt="">
                        </div>
                        <div class="review-item-content">
                            <div class="review-item-content-top">
                                <b>Floyd Miles</b>
                                <span>2 дня назад</span>
                            </div>
                            <div class="review-item-content-text">Leverage agile frameworks to provide a robust synopsis
                                for high level overviews. Iterative approaches to corporate strategy foster
                                collaborative thinking to further the overall value proposition. Organically grow the
                                holistic world view of disruptive innovation via workplace diversity and empowerment.
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="similar">
                <div class="similar-top">
                    <h2 class="title">Похожие</h2>
                    @if(count($news) >= 4)
                        <a href="/news" class="btn-main">Посмотреть все</a>
                    @endif
                </div>
                <div class="similar-list">
                    @foreach($news as $sNew)
                        <div class="similar-item">
                            <div class="similar-item-img">
                                <img src="{{ url('/storage/' . $sNew->image) }}" alt="">
                            </div>
                            <div class="similar-item-caption">
                                <h6>{{ $sNew->name }}</h6>
                                <span>Floyd Miles</span>
                                <span>3 Days Ago</span>
                            </div>
                            <a href="/news/{{ $sNew->alias }}" class="absolute-link"></a>
                        </div>
                    @endforeach
                </div>
                @if(count($news) >= 4)
                    <a href="/news" class="btn-main similar-btn-sm">Посмотреть все<a/>
                @endif
            </div>
            @include('components.partners')
        </div>
    </div>
@endsection
