<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publication;

use App\User;

class publicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Publication::all();
        return view('admin.publications.index' , compact('p'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $u = User::where('role' , 2)->where('status' , 1)->get();
        return view('admin.publications.create' , compact('u'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user'    => 'required',
            'type'    => 'required',
            'status'  => 'required',
            'content' => 'required',
            'avatar'  => 'required',
        ] , [
            'user.required'    => 'Selecciona el usuario de la publicación',
            'type.required'    => 'Selecciona el tipo de publicación',
            'status.required'  => 'Selecciona el estatus de la publicación',
            'content.required' => 'Ingresa el contenido de la publicación',
            'avatar.required'  => 'Selecciona una foto para la publicación',
        ]);

        $u = User::find($request->user);

        $name_avatar = uniqid().md5($request->avatar->getClientOriginalName()).'.'.$request->avatar->getClientOriginalExtension();

        $p = new Publication;
        $p->name     = $u->username;
        $p->username = $u->username;
        $p->comment  = $request->content;
        $p->type     = $request->type;
        if ($request->type == 'c') {
            $p->avatar = url('/files/comments/'.$name_avatar);
            $request->avatar->move(public_path().'/files/comments/' , $name_avatar);
        }elseif($request->type == 'l'){
            $p->avatar = url('/files/likes/'.$name_avatar);
            $request->avatar->move(public_path().'/files/likes/' , $name_avatar);
        }else{
            $p->avatar = url('/files/videos/'.$name_avatar);
            $request->avatar->move(public_path().'/files/videos/' , $name_avatar);
        }
        $p->save();

        return redirect('/admin/publications')->with('msj' , 'Publicación agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = User::where('role' , 2)->where('status' , 1)->get();
        $p = Publication::find($id);
        return view('admin.publications.edit' , compact('u' , 'p'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user'    => 'required',
            'type'    => 'required',
            'status'  => 'required',
            'content' => 'required',
            // 'avatar'  => 'required',
        ] , [
            'user.required'    => 'Selecciona el usuario de la publicación',
            'type.required'    => 'Selecciona el tipo de publicación',
            'status.required'  => 'Selecciona el estatus de la publicación',
            'content.required' => 'Ingresa el contenido de la publicación',
            'avatar.required'  => 'Selecciona una foto para la publicación',
        ]);

        $u = User::find($request->user);


        $p = Publication::find($id);
        $p->name     = $u->username;
        $p->username = $u->username;
        $p->comment  = $request->content;
        $p->type     = $request->type;
        if ($request->avatar) {
            $name_avatar = uniqid().md5($request->avatar->getClientOriginalName()).'.'.$request->avatar->getClientOriginalExtension();
            if ($request->type == 'c') {
                $p->avatar = url('/files/comments/'.$name_avatar);
                $request->avatar->move(public_path().'/files/comments/' , $name_avatar);
            }elseif($request->type == 'l'){
                $p->avatar = url('/files/likes/'.$name_avatar);
                $request->avatar->move(public_path().'/files/likes/' , $name_avatar);
            }else{
                $p->avatar = url('/files/videos/'.$name_avatar);
                $request->avatar->move(public_path().'/files/videos/' , $name_avatar);
            }
        }
        $p->save();

        return back()->with('msj' , 'Publicación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Publication::find($id);
        @unlink($p->avatar);
        $p->delete();

        return redirect('/admin/publications')->with('msj' , 'Publicación eliminada exitosamente');
    }
}
