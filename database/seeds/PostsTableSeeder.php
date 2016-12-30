<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$upload = public_path('images'); // path dossier image dans le dossier public
    	// suprimer les images avant si le dossier images n'est pas vide
    	$files = File::allFiles($upload);
		foreach ($files as $file) {
			File::delete($file);
		}
    	// Pour chaque post créé on va associé une image2wbmp(image)
    	// use pour les fonctions anonyme récupère la variable dans le contexte du script englobant
    	
        factory(App\Post::class, 15)->create()->each(function($post) use ($upload){
        	$fileName = file_get_contents('http://lorempicsum.com/futurama/400/200/'.rand(1,9));

        	$uri = str_random(30). '.jpg'; // nom aléatoire  pour l'image

        	File::put($upload.'/'.$uri,$fileName);

        	//Eloquent modifier la valeur thumbnail pour ce post
        	$post->url_thumbnail = $uri;

        	$post->save(); // update

        	$comment = [];
        	$comment = factory(App\Comment::class, rand(1,5))->create();

			
			if (count($comment)>1) {
				$post->comments()->saveMany($comment);
			}
			else
				$post->comments()->save($comment);

        });
    }
}
