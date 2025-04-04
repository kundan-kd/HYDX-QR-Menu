<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function getSubcatData(Request $request)
    {
        $id = $request->id;
        $subcatData = SubCategory::where('id', $id)->get();
        $catid = $subcatData[0]->categoryid;
        $catData = Category::where('id', $catid)->get(['desc']);
        $category_name = $subcatData[0]->category_name;
        $subcategory = $subcatData[0]->subcategory;
        $desc = $catData[0]->desc;
        $response = ['id' => $id, 'catid' => $catid, 'catname' => $category_name, 'subcatname' => $subcategory, 'desc' => $desc];
        return $response;
    }
}
