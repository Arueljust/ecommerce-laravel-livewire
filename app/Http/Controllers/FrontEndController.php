<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    public function index()
    {
        $slider=Slider::where('status','0')->get();
        return view('frontend.index',compact('slider'));
    }


    public function category()
    {
        $category=Category::where('status','0')->get();
        return view('frontend.collection.category.index',compact('category'));
    }


    public function product($category_slug)
    {
        $category=Category::where('slug',$category_slug)->first();
        if($category){

            return view('frontend.collection.product.index',compact('category'));
        }else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug,string $product_slug)
    {
        $category=Category::where('slug',$category_slug)->first();
        if($category){

            $product=$category->product()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collection.product.view',compact('product','category'));
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        return view('frontend.thankyou');
    }
}
