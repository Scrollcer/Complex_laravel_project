<?php

use App\Models\Categories;
use App\Game;

?>
    <!DOCTYPE html>
<html lang="ru">
<head>
    <title>main - ГеймсМаркет</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('assets/css/libs.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/media.css')}}">
</head>
<body>
<div class="main-wrapper">
    <header class="main-header">
        <div class="logotype-container"><a href="/" class="logotype-link"><img src="{{asset('assets/img/logo.png')}}"
                                                                               alt="Логотип"></a>
        </div>
        <nav class="main-navigation">
            <ul class="nav-list">
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">Главная</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">Мои заказы</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">Новости</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">О компании</a></li>
            </ul>
        </nav>
        <div class="header-contact">
            <div class="header-contact__phone"><a href="#" class="header-contact__phone-link">Телефон: 33-333-33</a>
            </div>
        </div>
        <div class="header-container">
            @if(Auth::check())
                Вы вошли как {{Auth::user()->name}}. Добро пожаловать!
                <br>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Выйти
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @else
                <div class="authorization-block"><a href="{{ route('register') }}" class="authorization-block__link">Регистрация</a><a
                        href="{{ route('login') }}"
                        class="authorization-block__link">Войти</a>
                </div>
            @endif
        </div>
    </header>
    <div class="middle">
        <div class="sidebar">
            <div class="sidebar-item">
                <div class="sidebar-item__title">Категории</div>
                <div class="sidebar-item__content">
                    <ul class="sidebar-category">
                        @foreach($allCategories = Categories::all() as $category)
                            <li class="sidebar-category__item"><a
                                    href="{{route('categories', ['id'=>$category->id, 'name'=>$category->name])}}"
                                    class="sidebar-category__item__link">{{$category["name"]}}</a>
                            </li>
                            @if(Auth::check())
                                @if(Auth::user()->is_Admin)

                                    <a href="{{route('category.editPage', ['id' => $category->id])}}">Редактировать</a>

                                    <form action="{{route('category.delete', ['id' => $category->id])}}"
                                          method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" value="удалить">
                                    </form>

                                    <a href="{{route('category.addPage')}}">Добавить</a>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item__title">Последние новости</div>
                <div class="sidebar-item__content">
                    <div class="sidebar-news">
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news"><img
                                    src="{{asset('assets/img/cover/game-2.jpg')}}"
                                    alt="image-new"
                                    class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news"><a href="#"
                                                                           class="sidebar-news__item__title-news__link">О
                                    новых играх в режиме VR</a></div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news"><img
                                    src="{{asset('assets/img/cover/game-1.jpg')}}"
                                    alt="image-new"
                                    class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news"><a href="#"
                                                                           class="sidebar-news__item__title-news__link">О
                                    новых играх в режиме VR</a></div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news"><img
                                    src="{{asset('assets/img/cover/game-4.jpg')}}"
                                    alt="image-new"
                                    class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news"><a href="#"
                                                                           class="sidebar-news__item__title-news__link">О
                                    новых играх в режиме VR</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="content-top">
                <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск,
                    скачать Steam игры после оплаты
                </div>
                <div class="slider"><img src="{{asset('assets/img/slider.png')}}" alt="Image"
                                         class="image-main"></div>
            </div>
            <div class="content-middle">
                <div class="content-head__container">
                    <div class="content-head__title-wrap">
                        <div class="content-head__title-wrap__title bcg-title">Товары</div>
                    </div>
                </div>
            </div>
            <div class="content-main__container">
                <div class="products-columns">
                    <?php
                    $games = Game::query()->orderBy('id', 'DESC')->get();
                    ?>
                    @foreach($games as $game)
                        <div class="products-columns__item">
                            <div class="products-columns__item__title-product"><a
                                    href="{{route('game', ['id'=>$game->id])}}"
                                    class="products-columns__item__title-product__link">
                                    {{$game->name}}</a></div>
                            <div class="products-columns__item__thumbnail"><a
                                    href="{{route('game', ['id'=>$game->id])}}"
                                    class="products-columns__item__thumbnail__link">
                                    <img
                                        src="{{asset($game->image)}}"
                                        alt="Preview-image"
                                        class="products-columns__item__thumbnail__img"></a></div>
                            <div class="products-columns__item__description"><span
                                    class="products-price">{{$game->price}}</span><a
                                    href="{{route('cart.buy', ['id'=>$game->id, 'name'=>$game->name])}}"
                                    class="btn btn-blue">Купить</a></div>
                        </div>
                        @if(Auth::check())
                            @if(Auth::user()->is_Admin)

                                <a href="{{route('game.editPage', ['id' => $game->id])}}">Редактировать</a>

                                <form action="{{route('game.delete', ['id' => $game->id])}}"
                                      method="post">
                                    {{ csrf_field() }}
                                    <input type="submit" value="удалить">
                                </form>

                                <a href="{{route('game.addPage')}}">Добавить</a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<footer class="footer">
    <div class="footer__footer-content">
        <div class="random-product-container">
            <div class="random-product-container__head">Случайный товар</div>
            <div class="random-product-container__content">
                <div class="item-product">
                    <div class="item-product__title-product"><a href="#" class="item-product__title-product__link">The
                            Witcher 3: Wild Hunt</a></div>
                    <div class="item-product__thumbnail"><a href="#" class="item-product__thumbnail__link"><img
                                src="{{asset('assets/img/cover/game-1.jpg')}}" alt="Preview-image"
                                class="item-product__thumbnail__link__img"></a></div>
                    <div class="item-product__description">
                        <div class="item-product__description__products-price"><span
                                class="products-price">400 руб</span></div>
                        <div class="item-product__description__btn-block"><a href="#"
                                                                             class="btn btn-blue">Купить</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__footer-content__main-content">
            <p>
                Интернет-магазин компьютерных игр ГЕЙМСМАРКЕТ - это
                онлайн-магазин игр для геймеров, существующий на рынке уже 5 лет.
                У нас широкий спектр лицензионных игр на компьютер, ключей для игр - для активации
                и авторизации, а также карты оплаты (game-card, time-card, игровые валюты и т.д.),
                коды продления и многое друго. Также здесь всегда можно узнать последние новости
                из области онлайн-игр для PC. На сайте предоставлены самые востребованные и
                актуальные товары MMORPG, приобретение которых здесь максимально удобно и,
                что немаловажно, выгодно!
            </p>
        </div>
    </div>
    <div class="footer__social-block">
        <ul class="social-block__list bcg-social">
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                        class="fa fa-facebook"></i></a></li>
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                        class="fa fa-twitter"></i></a></li>
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                        class="fa fa-instagram"></i></a></li>
        </ul>
    </div>
</footer>
</div>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
