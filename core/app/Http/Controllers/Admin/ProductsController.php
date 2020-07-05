<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productModel->all();
        $empty_message = 'No products to show!';

        $page_title = 'Products Management';
        return view('admin.products.index', compact('products', 'page_title', 'empty_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Product";
        return view('admin.products.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd(public_path(config('constants.product_image_path')));
        $validator = $this->validateRequest($request);
//        dd($request->all());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image', '_token', 'status');

        $data['status'] = $request->status == 'on' ? 1 : 0;
        $data['images'] = uniqid() . time() . '.' . $request->file('image')->clientExtension();
        $request->file('image')->move(config('constants.product_image_path'), $data['images']);
        $data['sku'] = $this->generateSku($request->name);
        $this->productModel->create($data);
        session()->flash('notify', [['success', 'Product created!']]);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productModel->findOrFail($id);
        $page_title = "Edit Product";
        return view('admin.products.edit', compact('page_title', 'product'));
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
        $validator = $this->validateRequest($request, true);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = $this->productModel->findOrFail($id);
        $data = $request->except('_method', '_token', 'image', 'status');
        $data['status'] = $request->status == 'on' ? 1 : 0;
        if ($request->hasFile('image')) {
            $data['images'] = uniqid() . time() . '.' . $request->file('image')->clientExtension();
            $request->file('image')->move(config('constants.product_image_path'), $data['images']);
            if (file_exists(config('constants.product_image_path') . '/' . $product->images)) {
                unlink(config('constants.product_image_path') . '/' . $product->images);
            }
        }

        $product->update($data);
        session()->flash('notify', [['success', 'Product updated!']]);
        return redirect()->to(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productModel->findOrFail($id);
        if (file_exists(get_image(config('constants.product_image_path') . '/' . $product->images))) {
            unlink(config('constants.product_image_path') . '/' . $product->images);
        }
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    private function generateSku($product_name)
    {
        return Str::limit(Str::slug($product_name), 4, '') .
            rand(rand(0, 9), rand(0, 9)) .
            rand(rand(0, 9), rand(0, 9)) .
            rand(rand(0, 9), rand(0, 9)) .
            rand(rand(0, 9), rand(0, 9));
    }

    private function validateRequest($request, $image_optional = false)
    {

        $rule = $image_optional == true ? 'sometimes|' : '';
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3',
                'stock' =>  'required|integer',
                'price' =>  'required|integer',
                'stock_alert'   =>  'integer',
                'description'   =>  'string|min:450|max:450',
                'image' => $rule . 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
    }
}
