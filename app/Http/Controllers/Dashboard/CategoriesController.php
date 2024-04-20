<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //(Request $request) get data or 
    {
        $request = request();
        $categories = Categorie::with('parent')
        /*leftjoin(
            'categories as parents',
            'parents.id',
            '=',
            'categories.parent_id'
        )
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/
            /*->select('categories.*')
            ->selectRaw('(SELECT COUNT(*) FROM products WHERE categories.id) as product_count')
            également Ce code calcule le nombre de produits*/
            ->withCount([
                'products as products_number' => function($query){
                    $query->where('status','=','active');
                }
            ]) //relationship : Ce code calcule le nombre de produits
            ->Filter($request->query())
            ->orderBy('categories.name')  //shorting by column name
            ->paginate(5);


        return view('dashboard.categories.index', compact('categories'));



        //global scope
        //$categories = Categorie::status('active')->paginate();
        //local scop
        //$categories = Categorie::active()->paginate();
        //$categories = Categorie::active()->paginate();

        //return collection

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Categorie::all();
        $category = new Categorie();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*CREATE METHODE IN MODELCATEORY
        //Validations of form input  
        $request->validate([
            'name'      => 'required|min:3|max:255',
            'parent_id' => [
                'nullable' ,'int', 'exists : categories , id'
            ],
            'image'  => [
                'image', 'max:10248576'
            ],
            'status' => 'in:active,archived',

        ]);
        */
        $request->validate(Categorie::rules(), [
            //'name the rule' => 'message error'
            'required' => 'this field is require',
            'unique' => 'this is not unique'
        ]);


        //request merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->UploadImage($request);

        //mass assignment
        $category = Categorie::create($data);

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categories)
    {
        return view('dashboard.categories.show',[
            'category' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Categorie::findOrFail($id);
        } catch (Exception $e) {
            //abort(404);
            return Redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }
        //SELECT*FROM categorie WHERE id <> $id 
        //ANd parent_id IS NULL OR parent_id <> $id
        $parents = Categorie::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->wherenull('parent_id')
                    ->orWhere('parent_id', '<>', $id); //عدم ضهور ابناء category حالي في الاedit

            })
            ->get();
        //-> dd(); pour excute un query to sql code

        return view('dashboard.categories.edit', compact('category', 'parents'));
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
        $request->validate(Categorie::rules($id));

        $category = Categorie::findOrFail($id);

        $old_img = $category->image;
        $data = $request->except('image');

        $category->update($data);

        $new_img = $this->UploadImage($request);

        if ($new_img) {
            $data['image'] = $new_img;
        }

        if ($old_img && $new_img) {
            Storage::disk('public')->delete($old_img);
        }



        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Updated!');




        //modifier in object not database
        //$category->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
        //pi ikhtissar
        //Categorie::destroy($id);

        /*
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        */
        //condition for if you id = $id
        //Categorie::where('id','=',$id)->delete();

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted!');
    }

    protected function UploadImage(Request $request)
    {

        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    //data corbeille
    public function trash()
    {
        $categories = Categorie::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    
    }
    
    //Restore record
    public function restore(Request $request,$id)
    {
        $categories= Categorie::onlyTrashed()->findOrFail($id);
        $categories->restore();
        
        return redirect()->route('dashboard.categories.trash')
        ->with('succes','Category restored!')
        ;
    }
    //delete record
    public function forceDelete($id)
    {
        $categories= Categorie::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();

        return redirect()->route('dashboard.categories.trash')
        ->with('succes','Category Deleted forever!')
        ;
    }
}
