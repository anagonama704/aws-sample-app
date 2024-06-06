<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Rental;
use App\Models\Cart;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(Book::class);
        //書籍検索
        $book_name_keyword = $request->book_name_keyword;//書籍名のキーワード
        $author_name_keyword = $request->author_name_keyword;//著者名のキーワード
        $publisher_name_keyword = $request->publisher_name_keyword;//出版社名のキーワード
        $category_id = $request->category_id;
        $is_rentable = $request->is_rentable;//貸出可否
        $sort = '';//ソート

        $categories = Category::all();
        $carts = Cart::query();
        $rentals = Rental::query();
        //貸出可否の確認
        if (!empty($is_rentable)) {
            $books = Book::all();
            if($is_rentable == "enable"){ //rentalsにないbookも貸出可能
                // $query = Book::whereHas('rental', function ($q) use ($books) {
                //     $q->whereNotNull('return_date');//返却された書籍
                // });
                $query = Book::whereDoesntHave('rental', function(Builder $q) use($books) {
                    $q->whereNull('return_date');
                });
                // dd('o');
            }else{
                $query = Book::whereHas('rental', function (Builder $q) use ($books) {
                    $q->whereNull('return_date');
                });
                    // dd('o');
            }
        }else{
            $query = Book::query();
        }


        $query->with('rental')->withCount('likes')->withCount('rental');
        //書籍名で絞る
        if ($book_name_keyword) {
            $query->where('name', 'LIKE', '%'. $book_name_keyword. '%');
        }

        //著者名で絞る
        if ($author_name_keyword) {
            $query->where('author', 'LIKE', '%'. $author_name_keyword. '%');
        }

        //出版社名で絞る
        if ($publisher_name_keyword) {
            $query->where('publisher', 'LIKE', '%'. $publisher_name_keyword. '%');
        }

        //カテゴリ指定
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        //ソート
        if(isset($request->sort))
        {
            $sort = $request->sort;
            if ($sort == "liked_desc")//人気順
            {
                $query->orderBy('likes_count', 'desc');
            }elseif($sort == "rented_desc")//貸出数順
            {
                $query->orderBy('rental_count', 'desc');
            }else{
                $query = $query->orderBy('id', 'desc');//新着順
            }
        } else {
            $query = $query->orderBy('id', 'desc');//新着順
        }

        $books = $query->paginate(15);

        return view('books.index', [
            'books' => $books,
            'categories' => $categories,
            'carts' => $carts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        $this->authorize($book);
        $categories = Category::all();
        return view('books.create',compact('book','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(Book::class);
        $this->validate($request,[
            'name'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'file' => 'mimes:png,jpg,jpeg',
        ]);
        $book = new Book;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->category_id = $request->category_id;
        if($request->file)
        {
            $request->file('file')->store('public');
            $book->image = $request->file('file')->hashName();
        }
        $book->save();
        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $this->authorize($book);
        return view('books.show',['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize($book);
        $categories = Category::all();
        return view('books.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize($book);
        $this->validate($request,[
            'name'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'file' => 'mimes:png,jpg,jpeg',
        ]);

        if ($request->file) {
            $request->file('file')->store('public');
            $content = array('image' => $request->file('file')->hashName());
            $request->merge($content);
        }
        $book->update($request->all());

        return redirect(route('books.show',$book->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize($book);
        $book->delete();
        return redirect(route('books.index'));
    }
}
