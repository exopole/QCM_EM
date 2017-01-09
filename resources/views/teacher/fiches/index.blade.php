@extends('layouts.app')

@section('content')
<!-- action="{{url('teacher', 'posts')}}" -->
<div>Articles <a href="{{url('teacher/fiches/questions/create')}}"> Ajouter</a> </div>
<!-- <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
 -->
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
       classe
    </div>
    <div class="col-md-2">
       Status (publié, dépublié)
    </div>
</div>
@if(count($questions)>0)
    @foreach($questions as $question)

        <div class="form-group row">
            <input type="checkbox" name="idArray[]" class="col-md-1 control-label" value="{{$question->id}}">

            <div class="col-md-2"  >
               <a href="{{url('teacher/fiches/questions/'.$question->id.'/edit')}}" id="question_{{$question->id}}_title">{{$question->title}} </a>
            </div>
            <div class="col-md-2">
               {{$question->class_level}}
            </div>
            <div class="col-md-2">
               {{getStatus($question->status)}}
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
        <h4 class="modal-title">Edition d'une fiche</h4>
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
<!-- </form>
 -->
{{ $questions->links() }}
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
            message += 'Etes vous sur de vouloir publié le(s) fiche(s) : '
        }
        else if (status == 'unpublished') {
            message += 'Etes vous sur de vouloir dépublié le(s) fiche(s) : '
        }
        else if (status == 'delete') {
            message += 'Etes vous sur de vouloir supprimé le(s) fiche(s) : '
        }   

        for (var i = 0; i < posts.length; i++) {
            message += $('#question_' + posts[i] +'_title').text();
        }
         $("#edition").text(message);

    }
    $('#valider').bind('click', function(e){
        
       let status = $('#status option:selected').val(); // Permet d'extraire le status
       if (status == 'published' || status === 'unpublished') {
            $.ajax({
                url: '{{url('teacher/fiches')}}/',
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
          let fiches =$('input:checked').map(function(){
            return $(this).val();
          });      
          for (var i = 0; i < fiches.length; i++) {
              let id = fiches[i];
            $.ajax({
              url: '{{url('teacher/fiches')}}/' + id,
              type: 'post',
              data: {
                  _method : 'delete',
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
    
       }
        
 });
</script>
@endsection

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message')}}
    </div>
@endif