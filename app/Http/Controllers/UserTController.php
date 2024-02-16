<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserT;

class UserTController extends Controller
{
    public function index(Request $request)
    {
        $userst = UserT::query();
        if ($request->query('name')) {
            $userst->where('name', 'ilike', '%' . $request->query('name') . '%');
        }
        if ($request->query('id')) {
            $userst->where('id', $request->input('id'));
        }
        if ($request->query('birth_date')) {
            $userst->where('birth_date', $request->input('birth_date'));
        }
        $userst->orderBy('id');
        if ($request->header('Content-Type') === 'application/json') {
            $userst = $userst->get();
            return response()->json($userst);
        } else {
            $max = $request->input('max') ? $request->input('max') : 5;
            $userst = $userst->paginate($max);
            $userst->appends($request->query());
            $filterFields = array(
                array(
                    'name' => 'name',
                    'placeholder' => 'Nombre'
                ),
                array(
                    'name' => 'id',
                    'type' => 'number',
                    'placeholder' => 'ID'
                ),
                array(
                    'name' => 'birth_date',
                    'type' => 'date',
                    'placeholder' => 'Fecha de Nacimiento'
                )
            );
            $colsNames = array(
                "id" => "ID",
                "name" => "Nombre",
                "birth_date" => "Fecha de Nacimiento"
            );
            $actions = array(
                "edit" => "edit",
                "delete" => "delete"
            );
            return view('usert.index', [
                'users' => $userst,
                'title' => 'Usuarios',
                'query' => $request->query(),
                'colsNames' => $colsNames,
                'filterFields' => $filterFields,
                'actions' => $actions
            ]);
        }
    }
    public function show($id)
    {
        return redirect()->route('user.edit', $id);

    }
    public function create()
    {
        return view('usert.create', [
            'formUrl' => route('user.store'),
            'fieldsObjects' => array(
                array(
                    'name' => 'name',
                    'type' => 'seach',
                    'placeholder' => 'Nombre',
                ),
                array(
                    'name' => 'birth_date',
                    'type' => 'date',
                    'placeholder' => 'Fecha de Nacimiento',
                ),
            ),
            "title" => "Usuarios"
        ]);
    }
    public function store(Request $request)
    {
        $user = new UserT();
        $user->name = $request->input('name');
        $user->birth_date = $request->input('birth_date');
        $user->save();
        if ($request->header('Content-Type') === 'application/json') {
            return response()->json($user);
        } else {
            $request->session()->flash('message', 'User created successfully');
            return redirect()->route('user.edit', $user->id);
        }

    }
    public function edit($id)
    {
        $user = UserT::find($id);
        return view('usert.edit', [
            'user' => $user,
            'formUrl' => route('user.update', $id),
            'fieldsObjects' => array(
                array(
                    'name' => 'name',
                    'type' => 'seach',
                    'placeholder' => 'Nombre',
                ),
                array(
                    'name' => 'birth_date',
                    'type' => 'date',
                    'placeholder' => 'Fecha de Nacimiento',
                ),
            ),
            "title" => "Usuarios"

        ]);
    }
    public function update(Request $request, $id)
    {
        $user = UserT::find($id);
        $user->name = $request->input('name');
        $user->birth_date = $request->input('birth_date');
        $user->save();
        if( $request->header('Content-Type') === 'application/json') {
            return response()->json($user);
        }
        $request->session()->flash('message', 'User updated successfully');
            return redirect()->route('user.edit', $user->id);
    }
    public function destroy($id, Request $request)
    {
        $user = UserT::find((int) $id);
        // $user->delete();
        if ($request->header('Content-Type') === 'application/json' || $request->header('HTTPRequest') === 'application/json') {
            return response()->json(['success' => "User deleted"]);
        } else {
            $request->session()->flash('message', 'User deleted successfully');
            return redirect()->route('user.index');
        }

    }




}
