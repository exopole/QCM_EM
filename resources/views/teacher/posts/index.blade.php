@extends('layouts.app')

@section('content')
<!-- action="{{url('teacher', 'posts')}}" -->
<div>Articles <a href="{{url('teacher/posts/create')}}"> Ajouter</a> </div>
<form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

    <select name="action" id="status" >
        <option value="published">publié
        <option value="unpublished">dépublié
        <option value="delete">supprimé
    </select>
   <!--  <button type="submit" id="valider">Appliquer </button> -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" onclick="afficheModal()" data-target="#myModal">Appliquer</button>


<div class="form-group row">
    <div class="col-md-1">
       
    </div>

    <div class="col-md-2">
       Titre
    </div>
    <div class="col-md-2">
       Auteur
    </div>
    <div class="col-md-2">
       Nombre de commentaires
    </div>
    <div class="col-md-2">
       Status (publié, dépublié)
    </div>
    <div class="col-md-2">
       date
    </div>
</div>
@if(count($posts)>0)
    @foreach($posts as $post)

        <div class="form-group row">
            <input type="checkbox" name="postsID[]" class="col-md-1 control-label" value="{{$post->id}}">

            <div class="col-md-2"  >
               <a href="{{url('teacher/posts/'.$post->id.'/edit')}}" id="post_{{$post->id}}_title">{{$post->title}} </a>
            </div>
            <div class="col-md-2">
               {{$post->user->username}}
            </div>
            <div class="col-md-2">
               {{count($post->comments)}} comentaires
            </div>
            <div class="col-md-2">
               {{getStatus($post->status)}}
            </div>
            <div class="col-md-2">
               {{$post->date}}
            </div>
        </div>
    @endforeach
@else
    <p>désolé aucun article</p>
@endif

<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edition d'article(s)</h4>
      </div>
      <div class="modal-body" id="edition">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
        <button type="submit" class="btn btn-default" id="valider" >Oui</button>
      </div>
    </div>

  </div>
</div>
</form>

{{ $posts->links() }}
@endsection


@section('scripts')
<script>

    function afficheModal(){
        let status = $('#status option:selected').val();
        let message = "";
        let posts =$('input:checked').map(function(){

            return $(this).val();

            });
        
        
        if (status == 'published') {
            message += 'Etes vous sur de vouloir publié les articles : '
        }
        else if (status == 'unpublished') {
            message += 'Etes vous sur de vouloir dépublié les articles : '
        }
        else if (status == 'delete') {
            message += 'Etes vous sur de vouloir supprimé les articles : '
        }   

        for (var i = 0; i < posts.length; i++) {
            message += $('#post_' + posts[i] +'_title').text();
        }
         $("#edition").text(message);

    }
    $('#valider').bind('click', function(e){
        
       let status = $('#status option:selected').val(); // Permet d'extraire le status
       if (status == 'published' || status === 'unpublished') {
            $.ajax({
                url: '{{url('teacher/posts')}}/',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data){
                   console.log(data.message)
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                },
                error: function()
                {
                    console.log('errors')
                }
            });

       }
       else
       {
            $.ajax({
                url: '{{url('teacher/posts')}}/',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data){
                   console.log(data.message)
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                },
                error: function()
                {
                    console.log('errors')
                }
            });
       }
        
 });
</script>
@endsection

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message')}}
    </div>
@endif