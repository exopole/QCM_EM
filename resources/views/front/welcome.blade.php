<?php use Illuminate\Support\Str;?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>home</title>
</head>
<style>
 *{
    text-decoration: none;
    margin: 0;
    padding: 0;
 }
    header{
        /*background-color: red;*/
        border: 1px black solid;
        height: 50px;
        line-height: 50px;
        margin-bottom: 75px;
    }
    header div{
        float: left;
    }
    header .facebook{
        border-right: 1px black solid;
        width: 60%;

    }
    header .connexion{
        text-align: center;
        border-right: 1px black solid;
        width: 20%;

    }
    header .fb_twitter{
        text-align: center;
        width: 15%;

    }
    nav{
        /*background-color: cyan;*/
        border: 2px black solid;
        height: 50px;
        line-height: 50px;
    }

    ul li{
        width: 100px;
        display: inline-block;
        border-right: 1px black solid;
        text-align: center;

    }
    ul{
        margin-left: 10%;
        border-left: 1px black solid;
    }
    #wrapper{
        width: 750px;
        background-color: orange;
        margin: 0 auto;
    }
    #content{
        width: 60%;
        background-color: pink;
        float: left;
    }
    #sidebar{
        border: 1px black solid;
        margin-left: 15px;
        width: 35%;
    }
    footer{
        margin: 0 auto;
        text-align: center;
    }

</style>
<body>

    <header>
        <div class ="facebook">j'aime +1</div>
        @if (Route::has('login'))
                <div class="connexion">
                    <a href="{{ url('/login') }}">connexion</a>
                </div>
        @endif
        <div class ="fb_twitter">[F] [T]</div>
    </header>
    <nav>
        <ul>
            <li>Home</li><li>Actus</li><li>Le Lycée</li><li>Rechercher</li>
        </ul>
    </nav>
    <div id="wrapper">
        
        <div id="content">
            @yield('content')
        </div>
        <aside>
            <ul>
                @if(count($posts)>0)

                    @foreach($posts as $post)
                        
                        <li>-><a href="{{url('post',$post['id'])}}">{{$post->title}}</a></li>

                        <div>{{Str::limit($post->abstract, 50, '...')}}</div>
            
                    @endforeach
                @else
                    <p>désolé aucun article</p>
                @endif
            </ul>
        </aside>
    </div>
    <footer>
        <p>mentions légales | contact</p>
    </footer>
    
</body>
</html>
