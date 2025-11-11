<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    //
    public function index(Request $request){
        $books = Book::orderBy('created_at', 'DESC');
        if(!empty($request->keyword)){
            $books->where('title', 'like', '%'.$request->keyword.'%')
            ->orWhere('author', 'like', '%'.$request->keyword.'%');
        }
            
        $books = $books->paginate(5);
        return view('books.list', [
            'books'=>$books
        ]);
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request){

        $rules = [
            'title'=>'required|min:3|max:255',
            'author'=>'required|min:3|max:255',
            'status'=>'required',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'image';
        }

        $vlidator = Validator::make($request->all(), $rules);

        if($vlidator->fails()){
            return redirect()->route('books.create')->withInput()->withErrors($vlidator);
        }

        //Save Book in DB
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->save();

        if(!empty($request->image)){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books/'), $imageName);
            $book->image = $imageName;
            $book->save();

            $manager = new ImageManager(new Driver());
            $img = $manager->read(public_path('uploads/books/' . $imageName));
            $img->resize(990);
            $img->save(public_path('uploads/books/thumb/' . $imageName));
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully.');

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
