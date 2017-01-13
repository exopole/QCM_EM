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
    color: black;
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
    nav .br_none{
        border: none;
    }
    nav form{
        width: 500px;
        border-right: 1px black solid;
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
        width: 75%;
        background-color: orange;
        margin: 0 auto;
    }
    #content{
        width: 60%;
        /*background-color: pink;*/
        float: left;
        border: 1px black solid;
        margin-top: 5px;
    }
    #sidebar{
        float: left;
        border: 1px black solid;
        margin-left: 15px;
        width: 200px;
        text-align: left;
    }
    #sidebar ul , #sidebar li{
        border: none;
    }
    #wrapper .panel-body:first-child{
    -ms-transform: scale(1, 1.5); /* IE 9 */
    -webkit-transform: scale(1, 1.5); /* Safari */
    transform: scale(1, 1.5);
    margin-top: 5px;
    }
    #content .panel-body div{
        float: right;
    }

    #content .panel-body{
        clear: both;

    }
    footer{
        clear: both;
        margin: 0 auto;
        text-align: center;
    }

</style>
<body>

    <header>
        <div class ="facebook">j'aime +1</div>
        @if (Route::has('login'))
                <div class="connexion">
                    <a href="{{ url('/login') }}">connectez-vous</a>
                </div>
        @endif
        <div class ="fb_twitter">[F] [T]</div>
    </header>
    <nav>
        <ul>
            <a href="#"><li>Home</li></a><a href="{{url('/posts')}} "><li>Actus</li></a><a href="{{url('/lycee')}} "><li>Le Lycée</li></a><li class="br_none"><form class="searchform cf">
  <button type="submit">Search</button>
  <input type="text" placeholder="Is it me you’re looking for?">
</form></li>
        </ul>
    </nav>
    <div id="wrapper">
        
        <div id="content">
            @yield('content')
        </div>
        <aside id="sidebar">
        	<h2>A lire aussi</h2>
            <ul>
                @if(count($posts)>0)
                	<?php $i = 1 ?>
                	@while ( $i <= 5 && $i < count($posts)) 
	                        
	                        <li>-><a href="{{url('post',$posts[$i]->id)}}">{{$posts[$i]->title}}</a></li>
	            
                  
					<?php $i++;		?>
					@endwhile
                @else
                    <p>désolé aucun article</p>
                @endif
            </ul>
        </aside>
    </div>
    <footer>
        <p><a href="{{url('mention')}} ">mentions légales</a> | <a href="contact">contact</a></p>
    </footer>
    
</body>
</html>
