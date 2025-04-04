<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function getItemData(Request $request)
  {
    $labelidArray = [];
    $id = $request->id;
    $itemData = Item::where('id', $id)->get();
    $categoryid = $itemData[0]->categoryid;
    $subcategoryid = $itemData[0]->subcategoryid;
    $subcat_data = SubCategory::where('id', $subcategoryid)->get(['subcategory']);
    $subcat_name = $subcat_data[0]->subcategory;
    $item_name = $itemData[0]->item_name;
    $f_category = $itemData[0]->f_category;
    $mrp = $itemData[0]->mrp;
    $offer_price = $itemData[0]->offer_price;
    $desc = $itemData[0]->desc;
    $labelid = $itemData[0]->labels;
    $labelidArray = explode(',', $labelid);
    $item_image = $itemData[0]->item_image;
    $response = ['id' => $id, 'categoryid' => $categoryid, 'subcategoryid' => $subcategoryid, 'subcategory_name' => $subcat_name, 'item_name' => $item_name, 'f_category' => $f_category, 'mrp' => $mrp, 'offer_price' => $offer_price, 'desc' => $desc, 'labelidArray' => $labelidArray, 'item_image' => $item_image];
    return $response;
  }
  public function getitemtotal(Request $request)
  {
    $Cat_data = [];
    $subCat_data = [];
    $vn_data = [];
    $data = $request->data;
    foreach ($data as $items) {
      $category = $items["category"];
      $category_name = $items["category_name"];
      if ($category == "Category") {
        $catsubcat = Category::where('category', $category_name)->get(['total_subcat']);
        $tot_catsubcat = $catsubcat[0]->total_subcat;
        array_push($Cat_data, $tot_catsubcat);
      } else if ($category == "Sub Category") {
        $subcatitems = SubCategory::where('subcategory', $category_name)->get(['total_items']);
        $tot_subcatitems = $subcatitems[0]->total_items;
        array_push($subCat_data, $tot_subcatitems);
      }
    }
    $response = ['Category' => $Cat_data, 'SubCategory' => $subCat_data];
    return $response;
  }
}
