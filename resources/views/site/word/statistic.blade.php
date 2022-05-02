@extends('layouts.main')


@section('title', 'Статистика слов')

@section('root-classes', 'background-soft-purple ')

@section('content')

    <section id="content">
        <div class="back">
            <a href="{{ back()->getTargetUrl() }}">Назад</a>
        </div>

        <div class="block-statistic">
            <h3>Статистика</h3>

            <div class="result">
                <p class="count-words" data-count="{{ $statistic->first()->count_words  }}">Слов:
                    <span>{{ $statistic->first()->count_words }}</span></p>

                <p class="count-wrong" data-count="{{ $statistic->first()->count_wrong }}">Неправильные: <span>{{ $statistic->first()->count_wrong }}</span></p>

                <p class="count-right" data-count="{{ $statistic->first()->count_true }}">Правильные: <span>{{ $statistic->first()->count_true }}</span>
                </p>
            </div>

            <div class="percent">0</div>
            <div class="progress-bar">
                <div class="loaded"></div>
            </div>

        </div>

    </section>
@endsection

@push('js')
    <script>
        const loaded_bar = document.querySelector('.loaded');
        const percent = document.querySelector('.percent');

        const countWords = document.querySelector('.count-words').dataset.count;
        const countWrong = document.querySelector('.count-wrong').dataset.count;
        const countTrue = document.querySelector('.count-right').dataset.count;


        console.log(countWords, countTrue, countWrong)
        console.log(countTrue / (countWords / 100))

        const result = countTrue / (countWords / 100);

        // Указываем проценты для блока с загрузки
        loaded_bar.style.width = `${result}%`;

        let percent_show = setInterval(function () {
            if (+percent.innerHTML < Math.trunc(+result)) {
                percent.innerHTML = +percent.innerHTML + 1
            } else {
                clearInterval(percent_show);
            }
        }, 30);

    </script>
@endpush
