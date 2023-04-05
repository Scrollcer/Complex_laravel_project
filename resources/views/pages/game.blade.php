<?php

use App\Models\Categories;
use App\Models\Games;

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
                <li class="nav-list__item"><a href="/" class="nav-list__item__link">Главная</a></li>
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
            <div class="payment-container">
                <div class="payment-basket__status">
                    <div class="payment-basket__status__icon-block"><a class="payment-basket__status__icon-block__link"><i
                                class="fa fa-shopping-basket"></i></a></div>
                    <div class="payment-basket__status__basket"><span
                            class="payment-basket__status__basket-value">0</span><span
                            class="payment-basket__status__basket-value-descr">товаров</span></div>
                </div>
            </div>
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
            @foreach($games as $game)
                @if($game->id == request()->id)
                    <tr>
                        <td>{{$game->name}}</td>
                        <td>{{$game->price}} руб.</td>
                    </tr>
                    <br>
                    <img src="{{asset($game->image)}}">
                    <br>
                    <tr>
                        <td>
                            {{$game->description}}
                        </td>
                    </tr>
                    <br>
                    <a href="{{route('cart.buy', ['id'=>$game->id, 'name'=>$game->name])}}">
                        Купить
                    </a>
                    <br>
                    <br>
                @endif
            @endforeach
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
