<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->first_name = 'Maciej';
        $user->last_name = "Kos";
        $user->password =  '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // deafult laravel pass secret
        $user->email = 'ksomac@gmail.com';
        $user->save();

        $user = new \App\User();
        $user->first_name = 'Jakub';
        $user->last_name = "Nad";
        $user->password =  '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';  // deafult laravel pass secret
        $user->email = 'jbn@gmail.com'; 
        $user->save();
        factory(App\User::class,20)->create();



        $photo = new \App\Photo();
        $photo->path = '/storage/photos/bouldering.jpg';
        $photo->alt = 'bouldering';
        $photo->cover = 1;
        $photo->save();


        $photo = new \App\Photo();
        $photo->path = '/storage/photos/kregle.jpg';
        $photo->alt = 'kregle';
        $photo->cover = 1;
        $photo->save();


        $photo = new \App\Photo();
        $photo->path = '/storage/photos/rower.jpg';
        $photo->alt = 'rower';
        $photo->cover = 1;
        $photo->save();


        $photo = new \App\Photo();
        $photo->path = '/storage/photos/szachy.jpg';
        $photo->alt = 'szachy';
        $photo->cover = 1;
        $photo->save();


        $contest = new \App\Contest();
        $contest->name = "Zawody szachowe";
        $contest->desc = "Weź udział w wspaniałych zawodach z dużą iloscią wrażeń";
        $contest->owner()->associate(\App\User::where('id', 1)->first());
        $contest->photo()->associate(\App\Photo::where('id', 4)->first());
        $contest->save();


        $contest = new \App\Contest();
        $contest->name = "Zawody wspinaczkowe";
        $contest->desc = "Weź udział w wspaniałych zawodach z dużą iloscią wrażeń. Wspaniałe burdelki";
        $contest->owner()->associate(\App\User::where('id', 2)->first());
        $contest->photo()->associate(\App\Photo::where('id', 1)->first());
        $contest->save();

        $contest = new \App\Contest();
        $contest->name = "Wyścig rowerowy";
        $contest->desc = "Weź udział w wspaniałych zawodach z dużą iloscią wrażeń.";
        $contest->owner()->associate(\App\User::where('id', 5)->first());
        $contest->photo()->associate(\App\Photo::where('id',3)->first());
        $contest->save();

        $contest = new \App\Contest();
        $contest->name = "Turniej w kręgle";
        $contest->desc = "Weź udział w wspaniałych zawodach z dużą iloscią wrażeń.";
        $contest->owner()->associate(\App\User::where('id', 9)->first());
        $contest->photo()->associate(\App\Photo::where('id',2)->first());
        $contest->save();

        // seed contest users
        $contests = \App\Contest::all();
        foreach ($contests as $contest ){
            $x = rand(4,10);
            for($i=0; $i < $x; $i++){
                $contest_user = new \App\ContestUser();
                $contest_user->contest_id = $contest->id;
                $contest_user->user_id = \App\User::where('id', rand(1,20))->first()->id;
                $contest_user->accepted  = rand(0, 1);
                $contest_user->save();
            }

        }


        // seed contest result

        $contest_users = \App\ContestUser::where('accepted', 1)->get();
        foreach ($contest_users as $contest_user){
            $contest_result = new \App\ContestResult();
            $contest_result->contest_user_id  = $contest_user->id;
            $contest_result->score_result = rand(0,200);
            $contest_result->unit = 's';
            $contest_result->save();
        }

        // $this->call(UsersTableSeeder::class);
    }
}
