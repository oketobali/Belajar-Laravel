<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\ProductLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{
    //custom message
   protected $customMessage = [
        'regex' => 'The :attribute must only contain letters and space',
        'category_id.numeric' => 'Please select product category',
        'description' => 'Please provide description'
    ];


    //show all product from database
    //create pagination of 10 product per page
    public function index() {
        $products = Products::paginate(10);
        return view('products', compact('products'));
    }

    //input validator
  /*  public function validator(array $data){
        return Validator::make($data,[
            'product_name' => ['required', 'alpha', 'max:50'],
            'product_stock' => ['required', 'numeric', 'min:1'],
            'product_price' => ['required', 'numeric', 'min:1'],
            'category_id' => ['required', 'numeric']
        ]);
    } */

    //show add product form
    public function productForm( $id = null ){
        $categories = Category::all()->sortBy('category');

        if($id === null) return view('productForm', compact('categories'));

        try {
            $productById = Products::findOrFail($id);
        } catch (QueryException $exception) {
            return redirect()->route('product')->with('message', 'Product Not Found!');
        }

        return view('productForm', compact('categories', 'productById'));
    }

    //store newly created product to database and send message to view
    public function createProduct(Request $request){
        $request->validate([
            'product_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:50',
            'product_stock' => 'required|numeric|min:1',
            'product_price' => 'required|numeric|min:1',
            'category_id' => 'required|numeric'
        ], $this->customMessage);

        try {
            //insert new product to Products Database
            $success = Products::create($request->all());

            //insert newly created product to Product Logs Database
            $logs = new ProductLogs;
            $logs->product_id = $success->id;
            $logs->stock_update = $request->product_stock;
            $logs->description = 'Newly added product';
            $logs->updated_by = $request->created_by;

            $logs->save();

        } catch (QueryException $exception) {
            return redirect()->route('product')->with('message', 'Create Product Failed!');
        }

        return redirect()->route('product')->with('message', 'Product Successfully Created!');
    }

    //updating database by Id
    public function updateProduct(Request $request){

        $request->validate([
            'product_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:50',
            'product_stock' => 'required|numeric|min:1',
            'product_price' => 'required|numeric|min:1',
            'category_id' => 'required|numeric',
            'description' => 'required|regex:/^[a-zA-Z\s]*$/|min:10',
        ], $this->customMessage);

        try {

            $log = ProductLogs::where('product_id', $request->id)->first();
            if(
                $log->stock_update != $request->product_stock 
                || $log->price_update != $request->product_price
            ){
                $newLog= new ProductLogs;
                $newLog->product_id = $request->id;
                $newLog->stock_update = $request->product_stock;
                $newLog->price_update = $request->product_price;
                $newLog->description = $request->description;
                $newLog->updated_by = $request->created_by;
                $newLog->save();
            }

                $update = Products::where('id', $request->id)->first();
                $update->product_name = $request->product_name;
                $update->product_stock = $request->product_stock;
                $update->product_price = $request->product_price;
                $update->category_id = $request->category_id;
                $update->created_by = $request->created_by;
                $update->save();
            

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('message', 'Updating Product Failed!');
        }

        return redirect()->route('product')->with('message', 'Product Successfully Updated!');

    }

    //delete product from database and send message to view
    public function destroy($id){
        try {
            Products::where('id', $id)->delete();
        } catch (QueryException $exception) {
            return redirect()->back()->with('message', 'Deleting Product Failed!');
        }

        return redirect()->back()->with('message', 'Product Successfully Deleted!');
    }
}
