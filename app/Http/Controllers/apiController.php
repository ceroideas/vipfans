<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Publication;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use App\Like;
use App\Theme;
use App\Package;
use App\Earning;

class apiController extends Controller
{
    public function getAllUsers(){
        $u = User::where('role' , 2)->where('status' , 1)->inRandomOrder()->get();
        return $u;
    }
    public function getAllLikes(){
        $u = Publication::where('status' , 1)->where('type','l')->inRandomOrder()->get();
        return $u;
    }
    public function getAllComments(){
        $u = Publication::where('status' , 1)->where('type','c')->inRandomOrder()->get();
        // $u = User::where('role' , 2)->where('status' , 1)->inRandomOrder()->get();
        return $u;
    }
    public function getAllVideos(){
        $u = Publication::where('status' , 1)->where('type','v')->inRandomOrder()->get();
        return $u;
    }

    public function addMagnetism(Request $r , $id){
        $u = User::find($id);
        if ($u) {
            $u->magnetism = $r->magnetism;
            $u->save();
        }

        return $u;
    }

    public function addShowUser(Request $r){
        $u = User::where('instagram_id' , $r->sub)->first();
        if (!$u) {
            $u = new User;
            $u->instagram_id = $r->sub;
        }

        $u->name      = $r->name;
        $u->username  = $r->nickname; // vamos a usar el apellido para el nickname
        $u->email     = ""; // esto no es necesario aun
        // $u->gender    = $r->gender;
        // $u->city_id   = $r->city;
        // $u->theme     = $r->theme;
        $u->status    = 1;
        $u->password  = "";
        $u->role      = 2;
        $u->avatar    = $r->picture;
        $u->save();

        return $u;
    }

    public function getAllRestrictions(){
        $l = Like::first();
        return $l;
    }

    public function getGains(){
        $l = Earning::first();
        return $l;
    }

    public function saveInformation(Request $r){
        $u = User::find($r->id);
        $u->age        = $r->age;
        $u->gender     = $r->gender;
        $u->city_id    = $r->province;
        $u->theme      = $r->thematic;
        $u->email      = $r->email;
        $u->promotions = $r->promotions ? 1 : 0;

        $u->country_id = $r->country_id;
        $u->username   = $r->username;
        $u->save();

        return $u;
    }

    public function saveMagnetism(Request $r)
    {
        $u = User::find($r->id);
        $u->magnetism += $r->magnetism;
        $u->likes += $r->likes;
        $u->followers += $r->vipfans;
        $u->comments += $r->comments;
        $u->videos += $r->videos;
        $u->save();

        return $u;
    }

    public function resetMagnetism(Request $r)
    {
        $u = User::find($r->id);
        if(isset($r->magnetism)) {$u->magnetism = 0;}
        if(isset($r->likes)) {$u->magnetism += $u->likes; $u->likes = 0;}
        if(isset($r->vipfans)) {$u->magnetism += $u->followers; $u->followers = 0;}
        if(isset($r->comments)) {$u->magnetism += $u->comments; $u->comments = 0;}
        if(isset($r->videos)) {$u->magnetism += $u->videos; $u->videos = 0;}
        $u->save();

        return $u;
    }

    public function getTheme()
    {
        return Theme::orderBy("title","asc")->get();
    }

    public function getPackages()
    {
        return Package::where('status',1)->get();
    }

    public function migrar()
    {
        // Schema::create('publications', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name')->nullable();
        //     $table->string('username')->nullable();
        //     $table->string('comment')->nullable();
        //     $table->integer('status')->default(1);
        //     $table->string('type')->default('l'); // l = like / v = videos / c = comments
        //     $table->string('avatar')->nullable();
        //     $table->timestamps();
        //     //
        // });

        // $p = new Publication;
        // $p->status   = 1;
        // $p->type     = 'c';
        // $p->avatar   = url('/files/comments/comment_41.jpg');
        // $p->comment  = 'te amo';
        // $p->name     = 'karin792'; 
        // $p->username = 'karin792';
        // $p->save();

        // $p2 = new Publication;
        // $p2->status   = 1;
        // $p2->type     = 'c';
        // $p2->avatar   = url('/files/comments/comment_42.jpg');
        // $p2->comment  = 'te hecho de menos';
        // $p2->name     = 'antonietacolme'; 
        // $p2->username = 'antonietacolme';
        // $p2->save();

        // $p3 = new Publication;
        // $p3->status   = 1;
        // $p3->type     = 'c';
        // $p3->avatar   = url('/files/comments/comment_43.jpg');
        // $p3->comment  = 'pareces su hija jajaja';
        // $p3->name     = 'cesar_f1974'; 
        // $p3->username = 'cesar_f1974';
        // $p3->save();

        // $p4 = new Publication;
        // $p4->status   = 1;
        // $p4->type     = 'c';
        // $p4->avatar   = url('/files/comments/comment_44.jpg');
        // $p4->comment  = 'te quiero mucho';
        // $p4->name     = 'antonietacolme'; 
        // $p4->username = 'antonietacolme';
        // $p4->save();

        // $p5 = new Publication;
        // $p5->status   = 1;
        // $p5->type     = 'c';
        // $p5->avatar   = url('/files/comments/comment_45.jpg');
        // $p5->comment  = 'te veo de maravilla';
        // $p5->name     = 'santos_eva'; 
        // $p5->username = 'santos_eva';
        // $p5->save();

        // $p6 = new Publication;
        // $p6->status   = 1;
        // $p6->type     = 'c';
        // $p6->avatar   = url('/files/comments/comment_46.jpg');
        // $p6->comment  = 'tiempo en familia';
        // $p6->name     = 'carlos360'; 
        // $p6->username = 'carlos360';
        // $p6->save();

        // $p7 = new Publication;
        // $p7->status   = 1;
        // $p7->type     = 'c';
        // $p7->avatar   = url('/files/comments/comment_47.jpg');
        // $p7->comment  = 'tomandome un te';
        // $p7->name     = 'laurarojasss'; 
        // $p7->username = 'laurarojasss';
        // $p7->save();

        // $p8 = new Publication;
        // $p8->status   = 1;
        // $p8->type     = 'c';
        // $p8->avatar   = url('/files/comments/comment_48.jpg');
        // $p8->comment  = 'un dia muy especial';
        // $p8->name     = 'soriaalvaro'; 
        // $p8->username = 'soriaalvaro';
        // $p8->save();

        // $p9 = new Publication;
        // $p9->status   = 1;
        // $p9->type     = 'c';
        // $p9->avatar   = url('/files/comments/comment_49.jpg');
        // $p9->comment  = 'un dia soleado';
        // $p9->name     = 'laurarojasss'; 
        // $p9->username = 'laurarojasss';
        // $p9->save();

        // $p10 = new Publication;
        // $p10->status   = 1;
        // $p10->type     = 'c';
        // $p10->avatar   = url('/files/comments/comment_50.jpg');
        // $p10->comment  = 'vistas al lago';
        // $p10->name     = 'santos_eva'; 
        // $p10->username = 'santos_eva';
        // $p10->save();

        // $l = new Publication;
        // $l->status   = 1;
        // $l->type     = 'l';
        // $l->avatar   = url('/files/likes/like_41.jpg');
        // $l->comment  = 'enamorado hasta las trancas';
        // $l->name     = 'santos_eva'; 
        // $l->username = 'santos_eva';
        // $l->save();

        // $l2 = new Publication;
        // $l2->status   = 1;
        // $l2->type     = 'l';
        // $l2->avatar   = url('/files/likes/like_42.jpg');
        // $l2->comment  = 'estrenando piso';
        // $l2->name     = 'laurarojasss'; 
        // $l2->username = 'laurarojasss';
        // $l2->save();

        // $l3 = new Publication;
        // $l3->status   = 1;
        // $l3->type     = 'l';
        // $l3->avatar   = url('/files/likes/like_43.jpg');
        // $l3->comment  = 'estrenando sombrero';
        // $l3->name     = 'santos_eva'; 
        // $l3->username = 'santos_eva';
        // $l3->save();

        // $l4 = new Publication;
        // $l4->status   = 1;
        // $l4->type     = 'l';
        // $l4->avatar   = url('/files/likes/like_44.jpg');
        // $l4->comment  = 'estudiando';
        // $l4->name     = 'antonietacolme'; 
        // $l4->username = 'antonietacolme';
        // $l4->save();

        // $l5 = new Publication;
        // $l5->status   = 1;
        // $l5->type     = 'l';
        // $l5->avatar   = url('/files/likes/like_45.jpg');
        // $l5->comment  = 'excursion en el campo';
        // $l5->name     = 'asensio276'; 
        // $l5->username = 'asensio276';
        // $l5->save();

        // $l6 = new Publication;
        // $l6->status   = 1;
        // $l6->type     = 'l';
        // $l6->avatar   = url('/files/likes/like_46.jpg');
        // $l6->comment  = 'fiesta de empresa';
        // $l6->name     = 'cesar_f1974'; 
        // $l6->username = 'cesar_f1974';
        // $l6->save();

        // $l7 = new Publication;
        // $l7->status   = 1;
        // $l7->type     = 'l';
        // $l7->avatar   = url('/files/likes/like_47.jpg');
        // $l7->comment  = 'footing por el campo';
        // $l7->name     = 'pcampos88'; 
        // $l7->username = 'pcampos88';
        // $l7->save();

        // $l8 = new Publication;
        // $l8->status   = 1;
        // $l8->type     = 'l';
        // $l8->avatar   = url('/files/likes/like_48.jpg');
        // $l8->comment  = 'fotografiando';
        // $l8->name     = 'castillo99'; 
        // $l8->username = 'castillo99';
        // $l8->save();

        // $l9 = new Publication;
        // $l9->status   = 1;
        // $l9->type     = 'l';
        // $l9->avatar   = url('/files/likes/like_49.jpg');
        // $l9->comment  = 'grabando un videoclips';
        // $l9->name     = 'asensio276'; 
        // $l9->username = 'asensio276';
        // $l9->save();

        // $l10 = new Publication;
        // $l10->status   = 1;
        // $l10->type     = 'l';
        // $l10->avatar   = url('/files/likes/like_50.jpg');
        // $l10->comment  = 'hace un frio que pela';
        // $l10->name     = 'laurarojasss'; 
        // $l10->username = 'laurarojasss';
        // $l10->save();

        // $v = new Publication;
        // $v->status   = 1;
        // $v->type     = 'v';
        // $v->avatar   = url('/files/videos/video_41.jpg');
        // $v->comment  = 'amigo inseparable de viajes';
        // $v->name     = 'antonietacolme'; 
        // $v->username = 'antonietacolme';
        // $v->save();

        // $v2 = new Publication;
        // $v2->status   = 1;
        // $v2->type     = 'v';
        // $v2->avatar   = url('/files/videos/video_42.jpg');
        // $v2->comment  = 'como mola esta moto';
        // $v2->name     = 'cesar_f1974'; 
        // $v2->username = 'cesar_f1974';
        // $v2->save();

        // $v3 = new Publication;
        // $v3->status   = 1;
        // $v3->type     = 'v';
        // $v3->avatar   = url('/files/videos/video_43.jpg');
        // $v3->comment  = 'una feria de motocicletas';
        // $v3->name     = 'karina_ro20'; 
        // $v3->username = 'karina_ro20';
        // $v3->save();

        // $v4 = new Publication;
        // $v4->status   = 1;
        // $v4->type     = 'v';
        // $v4->avatar   = url('/files/videos/video_44.jpg');
        // $v4->comment  = 'uniendome a la naturaleza';
        // $v4->name     = 'karina_ro20'; 
        // $v4->username = 'karina_ro20';
        // $v4->save();

        // $v5 = new Publication;
        // $v5->status   = 1;
        // $v5->type     = 'v';
        // $v5->avatar   = url('/files/videos/video_45.jpg');
        // $v5->comment  = 'un evento inesperado!';
        // $v5->name     = 'karina_ro20'; 
        // $v5->username = 'karina_ro20';
        // $v5->save();

        // $v6 = new Publication;
        // $v6->status   = 1;
        // $v6->type     = 'v';
        // $v6->avatar   = url('/files/videos/video_46.jpg');
        // $v6->comment  = 'que guay es este cachorro';
        // $v6->name     = 'pcampos88'; 
        // $v6->username = 'pcampos88';
        // $v6->save();

        // $v7 = new Publication;
        // $v7->status   = 1;
        // $v7->type     = 'v';
        // $v7->avatar   = url('/files/videos/video_47.jpg');
        // $v7->comment  = 'orgullosa de mostrarme como soy';
        // $v7->name     = 'antonietacolme'; 
        // $v7->username = 'antonietacolme';
        // $v7->save();

        // $v8 = new Publication;
        // $v8->status   = 1;
        // $v8->type     = 'v';
        // $v8->avatar   = url('/files/videos/video_48.jpg');
        // $v8->comment  = 'nada como atrapar una buena ola';
        // $v8->name     = 'carlos360'; 
        // $v8->username = 'carlos360';
        // $v8->save();

        // $v9 = new Publication;
        // $v9->status   = 1;
        // $v9->type     = 'v';
        // $v9->avatar   = url('/files/videos/video_49.jpg');
        // $v9->comment  = 'a disfrutar!';
        // $v9->name     = 'carlos360'; 
        // $v9->username = 'carlos360';
        // $v9->save();

        // $v10 = new Publication;
        // $v10->status   = 1;
        // $v10->type     = 'v';
        // $v10->avatar   = url('/files/videos/video_50.jpg');
        // $v10->comment  = 'mira hacia aca';
        // $v10->name     = 'karin792'; 
        // $v10->username = 'karin792';
        // $v10->save();

        // $u = new User;
        // $u->name     = 'Lorena Gutiérrez';
        // $u->email    = 'lorena23@gmail.com';
        // $u->password = bcrypt('1234567');
        // $u->avatar   = url('/files/followers/follower_21.jpg');
        // $u->status   = 1;
        // $u->role     = 2;
        // $u->username = 'lorena23';
        // $u->vipfans  = 1;
        // $u->save();

        // $u2 = new User;
        // $u2->name     = 'Lourdes Lopez';
        // $u2->email    = 'lourdes_lopez56@gmail.com';
        // $u2->password = bcrypt('1234567');
        // $u2->avatar   = url('/files/followers/follower_22.jpg');
        // $u2->status   = 1;
        // $u2->role     = 2;
        // $u2->username = 'lourdes_lopez56';
        // $u2->vipfans  = 1;
        // $u2->save();

        // $u3 = new User;
        // $u3->name     = 'Lucrecia Sanchez';
        // $u3->email    = 'luucreciia8@gmail.com';
        // $u3->password = bcrypt('1234567');
        // $u3->avatar   = url('/files/followers/follower_23.jpg');
        // $u3->status   = 1;
        // $u3->role     = 2;
        // $u3->username = 'luucreciia8';
        // $u3->vipfans  = 1;
        // $u3->save();

        // $u4 = new User;
        // $u4->name     = 'Maite Rojas';
        // $u4->email    = 'maite03@gmail.com';
        // $u4->password = bcrypt('1234567');
        // $u4->avatar   = url('/files/followers/follower_24.jpg');
        // $u4->status   = 1;
        // $u4->role     = 2;
        // $u4->username = 'maite03';
        // $u4->vipfans  = 1;
        // $u4->save();

        // $u5 = new User;
        // $u5->name     = 'Maria Nuñez';
        // $u5->email    = 'marianuñez@gmail.com';
        // $u5->password = bcrypt('1234567');
        // $u5->avatar   = url('/files/followers/follower_25.jpg');
        // $u5->status   = 1;
        // $u5->role     = 2;
        // $u5->username = 'marianuñez';
        // $u5->vipfans  = 1;
        // $u5->save();

        // $u6 = new User;
        // $u6->name     = 'Miriam Suarez';
        // $u6->email    = 'miriam99@gmail.com';
        // $u6->password = bcrypt('1234567');
        // $u6->avatar   = url('/files/followers/follower_26.jpg');
        // $u6->status   = 1;
        // $u6->role     = 2;
        // $u6->username = 'miriam99';
        // $u6->vipfans  = 1;
        // $u6->save();

        // $u7 = new User;
        // $u7->name     = 'Mauricio Marquez';
        // $u7->email    = 'musico33@gmail.com';
        // $u7->password = bcrypt('1234567');
        // $u7->avatar   = url('/files/followers/follower_27.jpg');
        // $u7->status   = 1;
        // $u7->role     = 2;
        // $u7->username = 'musico33';
        // $u7->vipfans  = 1;
        // $u7->save();

        // $u8 = new User;
        // $u8->name     = 'Rafael Rey';
        // $u8->email    = 'rafa1994@gmail.com';
        // $u8->password = bcrypt('1234567');
        // $u8->avatar   = url('/files/followers/follower_28.jpg');
        // $u8->status   = 1;
        // $u8->role     = 2;
        // $u8->username = 'rafa1994';
        // $u8->vipfans  = 1;
        // $u8->save();

        // $u9 = new User;
        // $u9->name     = 'Gabriel Mota';
        // $u9->email    = 'surfero77@gmail.com';
        // $u9->password = bcrypt('1234567');
        // $u9->avatar   = url('/files/followers/follower_29.jpg');
        // $u9->status   = 1;
        // $u9->role     = 2;
        // $u9->username = 'surfero77';
        // $u9->vipfans  = 1;
        // $u9->save();

        // $u10 = new User;
        // $u10->name     = 'Hector Madrid';
        // $u10->email    = 'veterinario44@gmail.com';
        // $u10->password = bcrypt('1234567');
        // $u10->avatar   = url('/files/followers/follower_30.jpg');
        // $u10->status   = 1;
        // $u10->role     = 2;
        // $u10->username = 'veterinario44';
        // $u10->vipfans  = 1;
        // $u10->save();

    }
}