<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getData(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 5;

        $query = Book::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'ILIKE', "%$search%")
                  ->orWhere('author', 'ILIKE', "%$search%")
                  ->orWhere('category', 'ILIKE', "%$search%");
            });
        }

        $total = $query->count();
        $books = $query->orderBy('id', 'desc')
                       ->skip(($page - 1) * $perPage)
                       ->take($perPage)
                       ->get();

        return response()->json([
            'success' => true,
            'data' => $books,
            'total' => $total,
            'page' => $page
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:50',
            'category' => 'required|string|max:100',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:50',
            'category' => 'required|string|max:100',
        ]);

        $book->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diupdate',
            'data' => $book
        ]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
