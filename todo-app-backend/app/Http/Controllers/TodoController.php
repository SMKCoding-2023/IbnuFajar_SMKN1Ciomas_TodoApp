<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data_todo = Todo::latest()->get();

        if ($data_todo) {
            return new TodoResource(true, "List data todo", $data_todo);
        }

        return new TodoResource(false, "List data todo tidak ditemukan.", null);
    }

    /**
     * Store a newly created resource in storage
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $todo = Todo::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ]);

        if ($todo) {
            return new TodoResource(true, "Data todo berhasil disimpan!", $todo);
        }

        return new TodoResource(false, "Data todo gagal disimpan.", null);
    }

    /**
     * Show the form for editing the specified resource
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_todo = Todo::whereId($id)->first();

        if ($data_todo) {
            return new TodoResource(true, "Data Todo", $data_todo);
        }

        return new TodoResource(false, "Data todo tidak ditemukan.", null);
    }

    /**
     * Update the specified resource in storage
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Cari Todo berdasarkan ID
        $todo = Todo::find($id);

        // Jika Todo tidak ditemukan, kembalikan respons not found
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        // Update data Todo
        $todo->update($validatedData);

        if($todo){
            return new TodoResource(true, "Data todo berhasil diupdate", $todo);
        }
        return new TodoResource(false, "Data todo gagal diupdate", null);
    }


    /**
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari Todo berdasarkan ID
        $todo = Todo::find($id);
    
        // Jika Todo tidak ditemukan, kembalikan respons not found
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
    
        // Hapus Todo
        $todo->delete();
    
        // Kembalikan respons sukses
        return new TodoResource(true, "Todo berhasil dihapus!", null);
    }
    
}