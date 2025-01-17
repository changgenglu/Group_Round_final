<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/holdEvent.css')}}">
    <link rel="icon" href="{{ asset('img/logo.png')}}" type="image/gif" sizes="16x16">
    <script src="{{ asset('js/jquery-3.6.0.js')}}"></script>
    <title>團團轉 Group Round</title>
</head>
<script>
    $(function () {

       $(".category ").click(function () {
          $(this).find("p").toggleClass('font-main');
          $('img',this).toggle();
          $(this).find("img:first").toggleClass("selected");
       })

        
    })

    function getSelectedId(){   //取得所選圖片id
        var a =[];
        i=0;
        $(".selected").each(function(){
            a[i] = $(this).attr('id')
            i++;
        });

 
        $.ajax({          //ajax傳送到後端
            type: "POST",
            url: "/holdevent/store1",
            data: {'array':a,'_token':'{{csrf_token()}}'},
            success: function(test){
             window.location.href="holdevent2";}
        });

    }


    // $(".next").click(function(){

    //     console.log("next");
    // })

    // $.ajax({

    // })


    // $(".tog").click(function () {
    //     $('img',this).toggle();
    //     $(this).find("img:first").toggleClass("seleted");
    // });


    // $(".tog img").click(function () {
    //     const src = $(this).attr("src");
    //     var newSrc = src.slice(0,-4);
    //     console.log(src);
    //     console.log(newSrc);
    //     var togSrc = [ src, newSrc+'-focus.png')}}' ];
    //     this.src =  togSrc.reverse()[0];
    //     newSrc = src;
    // });

</script>
<body>
    <!-- 頁首 -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
            <div class="container-fluid">
                <!-- home -->
                <button type="button" class="btn">
                    <a class="navbar-brand" href="{{ route('home')}}">
                        <img src="{{ asset('img/logo-text-1.png') }}" type="image/gif" width="120px">
                    </a>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- 活動建立頁面 -->
                        <li class="nav-item">
                            <button type="button" class="btn btn-orange btn-sm"><a href="{{ route('eventcreate') }}" {{--活動route--}}
                                    class="link-light">辦活動</a></button>
                        </li>
                    </ul>

                    <form class="d-flex">
                        <!-- 搜尋 -->
                        <input class="form-control me-2 bg-light" type="search" placeholder="搜尋..." aria-label="Search">
                        <a href="{{ route('eventlist')}}"><button class="btn btn-secondary btn-sm" type="submit">
                            <img src="{{ asset('img/search.svg') }}" type="image/gif" size="16x16"></button>
                        </a>
                    </form>
                    
                    <!-- Authentication Links -->
                    <div class="nav-link link-dark">
                        @guest
                            <span class="nav-item">
                                <a class="nav-link link-dark" href="{{ route('login') }}">
                                    <img src="{{ asset('img/log-in.svg') }}" type="image/gif" size="16x16">{{ __('登入/註冊') }}
                                </a>
                            </span>
                        @else
                            @if(session()->has('LoggedUser'))
                            <span class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->userNickName }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('登出') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </span>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <div class="container">

        <!-- Oreder -->
        <div class="position-relative m-4">
            <div class="progress" style="height: 1px;">
                <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="100" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <button type="button"
                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-main rounded-pill"
                style="width: 2rem; height:2rem;">1</button>
            <button type="button"
                class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill"
                style="width: 2rem; height:2rem;">2</button>
            <button type="button"
                class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill"
                style="width: 2rem; height:2rem;">3</button>
        </div>

        <!-- Tag -->
        <div class="d-flex justify-content-center">
            <div style="width: 780px;">
                <h4 class="my-3 d-flex justify-content-center">選擇活動分類</h4>

                <div class="category scalebig">

                    <div class="category-img-container">
                        <img class="category-img" id="1" value="123" src="{{ asset('img/artCulture.png')}}" alt="Travel">
                        <img class="category-img" value="123" src="{{ asset('img/artCulture-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>藝文</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="2" src="{{ asset('img/nature.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/nature-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>生態與環境</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="3" src="{{ asset('img/learn.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/learn-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>學習</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="4" src="{{ asset('img/music.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/music-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>音樂</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="5" src="{{ asset('img/family.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/family-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>親子</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="6" src="{{ asset('img/pet.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/pet-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>寵物</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="7" src="{{ asset('img/outdoor.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/outdoor-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>旅遊與戶外</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="8" src="{{ asset('img/exercise.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/exercise-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>運動</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="9" src="{{ asset('img/spirit.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/spirit-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>宗教與心靈</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="10" src="{{ asset('img/science.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/science-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>科學與教育</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="11" src="{{ asset('img/social.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/social-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>社交</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="12" src="{{ asset('img/board.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/board-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>桌遊</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="13" src="{{ asset('img/escape.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/escape-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>密室逃脫</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="14" src="{{ asset('img/food.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/food-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>美食與品味</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="15" src="{{ asset('img/online.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/online-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>線上</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="16" src="{{ asset('img/cook.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/cook-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>烹飪</p>
                </div>
                <div class="category scalebig">
                    <div class="category-img-container">
                        <img class="category-img" id="17" src="{{ asset('img/camera.png')}}" alt="Travel">
                        <img class="category-img" src="{{ asset('img/camera-focus.png')}}" style="display: none;" alt="Travel">
                    </div>
                    <p>攝影</p>
                </div>




            </div>
        </div>





        <!-- Button -->
        <div class="d-flex justify-content-end mb-4">
            <!-- <input class="px-3 btn btn-secondary" id="btn" type="button" onclick="" value="上一步" /> -->
            <input class="px-3 btn btn-main next" id="btn" type="submit" onclick="getSelectedId()" value="下一步" />
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-lg-start">
        <div class="container ">
            <!-- Copyright -->
            <div class="text-center p-4 text-light">
                <span>© 2021 Copyright GroupRound團團轉共遊平台製作小組</span>
            </div>
        </div>
    </footer>
</body>

</html>