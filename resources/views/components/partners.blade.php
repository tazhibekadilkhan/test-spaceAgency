<div class="section partners">
    <h2 class="title">Партнеры и спонсоры</h2>
    <div class="partner-list">
        @foreach($partners as $partner)
            <div class="partner-item">
                <div class="partner-item-img">
                    <img src="{{ url('/storage/' . $partner->image) }}" alt="">
                </div>
                <div class="partner-item-caption">
                    <b>{{ $partner->name }}</b>
                    <p>{{ $partner->description }}</p>
                </div>
                {{--                            <a href="{{ $partner->link }}" class="absolute-link"></a>--}}
            </div>
        @endforeach
    </div>
</div>
