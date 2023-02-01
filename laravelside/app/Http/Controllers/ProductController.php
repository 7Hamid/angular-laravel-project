<?php
namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    //getProduct
    public function getProduct(){
        return response()->json(Product::all(),200);
    }

      //getProductById
      public function getProductById($id){
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'Produit introuvable'],404);
        }
        return response()->json(Product::find($id),200);
    }

   // add Product
   public function addProduct(Request $request){

    $product=new Product;
    if($request->hasFile('image')){
       $completeFileName=$request->file('image')->getClientOriginalName();
       $path=$request->file('image')->storeAs('public/posts',$completeFileName);
       $product->image=$completeFileName;
       $product->name=$request->name;
       $product->category=$request->category;
       $product->description=$request->description;
       $product->brand=$request->brand;
       $product->price=$request->price;
    }
    if($product->save()){
        return ['status'=>true,'message'=>'Product Saved Successfully'];
    }
    else{
        return ['status'=>false,'message'=>'Something Went Wrong'];
    }
}
   // update Product
   public function updateProduct(Request $request, $id){
    $product = Product::find($id);
    if(is_null($product)){
        
        return response()->json(['message' => 'Produit introuvable'],404);
    }
    else {
            $product->update($request->all());
    return response($product,200);
    }

}

   // delete Product
   public function deleteProduct(Request $request, $id){
    $product = Product::find($id);
    if(is_null($product)){
        return response()->json(['message' => 'Produit introuvable'],404);
    }
    $product->delete();
    return response(null,204);
    }

    //search product

    public function products(){
        $products=Product::all();
        return $products;
    }
    public function searchProduct(Request $request){
        $query=Product::query();
        $data=$request->input('search_product');
        if($data){
            $query->whereRaw("name LIKE '%" .$data. "%'")
            ->orWhereRaw("description LIKE '%" .$data. "%'")
            ->orWhereRaw("category LIKE '%" .$data. "%'")
            ->orWhereRaw("brand LIKE '%" .$data. "%'")
            ->orWhereRaw("price LIKE '%" .$data. "%'");
        }
        return $query->get();
    }

    public function download(Request $request,$id){
        if(Product::where('id',$id)->exists()){
            $product =Product::find($id);
            $path=$product->image;
            $f=public_path('/storage/posts/'.$path);
            return response()->download($f);

        }else{
            return response()->json([
                "message"=>"offer not found"
            ], 404);
        }
    }
} 