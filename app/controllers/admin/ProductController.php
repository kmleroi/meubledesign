<?php
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\classes\Validate;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\ProductMontage;
use App\Models\ProductStyle;
use App\Models\Rubric;
use App\Models\SubCategory;

class ProductController extends BaseController
{
    public $table_name = 'products';
    public $products;
    public $rubrics;
    public $collections;
    public $brands;
    public $styles;
    public $montages;
    public $materials;
    public $categories;
    public $subcategories;
    public $subcategories_links;

    public function __construct()
    {
       // if(!Role::middleware('admin')){
           // Redirect::to('/login');
       // }
        
        $this->subcategories = SubCategory::all();
        $this->categories = Category::all();
        $this->collections = Collection::all();
        $this->brands = Brand::all();
        $this->montages = ProductMontage::all();
        $this->styles = ProductStyle::all();
        $this->materials = ProductMaterial::all();
        $this->rubrics = Rubric::all();
    }
    
    public function show()
    {
        $products = $this->products;
        return view('admin/products/inventory', compact('products'));
    }
    
    public function showEditProductForm($id)
    {
        $categories = $this->categories;
        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();
        return view('admin/products/edit', compact('product', 'categories'));
    }
    
    public function showCreateProductForm()
    {
        $categories = $this->categories;
        return view('admin/products/create', compact('categories'));
    }
    public function add($id)
    {
        $subCat = SubCategory::where('id', $id)->first();
        $category = Category::where('id', $subCat->category_id)->first();
        $rubric = Rubric::where('id', $category->rubric_id)->first();
        $categories = $this->categories;
        $subcategories = $this->subcategories;
        $brands = $this->brands;
        $styles = $this->styles;
        $montages = $this->montages;
        $materials = $this->materials;
        $rubrics = $this->rubrics;
        $collections = $this->collections;
        return view('admin/products/addProduct', compact('categories','subCat','brands','styles',
            'materials','montages','category','subcategories','rubric','rubrics','collections'));

    }

    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'name' => [
                        'required' => true,
                        'length_min' => 3,
                        'length_max' => 30
                    ]
                ,'reference' => [
                        'required' => true,
                        'length_min' => 3
                    ]
                ),'products','name');
                if($validation->passed()) {
                    $errors = [];
                    $duplicate_products = Product::where('name', $request->name)
                        ->where('sub_category_id', $request->sub_category_id)->exists();
                    if($duplicate_products){
                        $errors[] = 'Ce produit existe déjà dans cette sous-catégorie';
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                    }
                    else{
                        $category = Category::where('id', $request->category_id)->exists();
                        if(!$category){
                            $errors[]='Catégorie invalide';
                            header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                            echo json_encode($errors);
                            exit;
                        }
                        else{
                            $subcategory = SubCategory::where('id', $request->sub_category_id)->exists();
                            if(!$subcategory){
                                $errors[]='Sous-catégorie invalide';
                                header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                                echo json_encode($errors);
                                exit;
                            }else{
                                //process form data
                                $lastId = Product::create([
                                    'name' => $request->name,
                                    'category_id' => $request->category_id,
                                    'sub_category_id' => $request->sub_category_id,
                                    'reference' => $request->reference,
                                    'brand_id' => $request->brand,
                                    'view' => slug($request->view)
                                ])->id;
                                echo $lastId;
                                exit;
                            }
                        }
                    }
                }
                else {
                    $errors = [];
                    foreach($validation->errors() as $error)
                    {
                        $errors [] = $error;
                    }
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function edit($id)
    {
        $categories = $this->categories;
        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();
        return view('admin/products/editProduct', compact('product', 'categories'));
        //$subCat = SubCategory::where('id', $id)->first();
        //$categorie = Category::where('id', $subCat->category_id)->first();
        //return view('admin/products/formCategory', compact('subCat','categorie','listeCat'));
    }
    public function activation($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            //if(CSRFToken::verifyCSRFToken($request->token, false)){
            if(!empty($_POST)) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'view' => ['numeric' => true]));
                if($validation->passed()) {
                    //process form data
                    Product::where('id', $id)->update([
                        'view' =>$request->view
                    ]);
                    echo json_encode(['success' => 'Record Update Successfully']);
                    exit;
                }
                else {
                    foreach($validation->errors() as $error)
                    {
                        $errors [] = $error;
                    }
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
            }

            //}
            //throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function update()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            $file_error = [];
        
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3,'maxLength' => 70, 'mixed' => true],
                    'price' => ['required' => true, 'minLength' => 2, 'number' => true],
                    'quantity' => ['required' => true],
                    'category' => ['required' => true], 'subcategory' => ['required' => true],
                    'description' => ['required' => true, 'mixed' => true, 'minLength' => 4,'maxLength' => 500,]
                ];
            
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
            
                $file = Request::get('file');
                isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';
            
                if(isset($file->productImage->name) && !UploadFile::isImage($filename)){
                    $file_error['productImage'] = ['The image is invalid, please try again.'];
                }
            
                if($validate->hasError()){
                    $response = $validate->getErrorMessages();
                    count($file_error) ? $errors = array_merge($response, $file_error) : $errors = $response;
                    return view('admin/products/create', [
                        'categories' => $this->categories, 'errors' => $errors
                    ]);
                }
                
                $product = Product::findOrFail($request->product_id);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->sub_category_id = $request->subcategory;
            
                if($filename){
                    $ds = DIRECTORY_SEPARATOR;
                    $old_image_path = BASE_PATH."{$ds}public{$ds}$product->image_path";
                    $temp_file = $file->productImage->tmp_name;
                    $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();
                    unlink($old_image_path);
                    $product->image_path = $image_path;
                }
                $product->save();
                Session::add('success', 'Record Updated');
                Redirect::to('/admin/products');
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    
    public function delete($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                Product::destroy($id);
                echo 'success';
                exit;
                //Session::add('success', 'Product Deleted');
                //Redirect::to('/admin/products');
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    
    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        echo json_encode($subcategories);
        exit;
    }
    public function getCollections($id)
    {
        $collections = Collection::where('brand_id', $id)->get();
        echo json_encode($collections);
        exit;
    }
}