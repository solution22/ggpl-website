<?php
/**
 * File name: ProductController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Products\ProductsOfUserCriteria;
use App\DataTables\ProductDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\MarketRepository;
use App\Repositories\ProductRepository;
use App\Repositories\InventoryRepository;
use App\Repositories\CustomerGroupsRepository;
use App\Repositories\ProductPriceVariationRepository;
use App\Repositories\UomRepository;
use App\Repositories\UploadRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\ProductReviewRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use DB;
use App\Models\InventoryTrack;
use App\Models\Product;
use App\Models\ProductpriceVariation;
use DataTables;
use PDF;
use App\Mail\PriceDropMail;
// use App\Mail\CustomerPurchaseMail;
// use App\Mail\BirthdayDiscountMail;
use CustomHelper;
use Cart;
use Cookie;

class ProductController extends Controller
{
    /** @var  ProductRepository */
    private $productRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;
    /**
     * @var MarketRepository
     */
    private $marketRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CustomerGroupsRepository
     */
    private $customerGroupRepository;
    /**
     * @var ProductPriceVariationRepository
     */
    private $productPriceVariationRepository;
    /**
     * @var UomRepository
     */
    private $uomRepository;
    /**
     * @var FavoriteRepository
     */
    private $favoriteRepository;
    /**
     * @var ProductReviewRepository
     */
    private $productReviewRepository;


    public function __construct(ProductRepository $productRepo, UploadRepository $uploadRepo
        , MarketRepository $marketRepo
        , CategoryRepository $categoryRepo, InventoryRepository $inventoryRepo, CustomerGroupsRepository $customerGroupRepo, UomRepository $uomRepo, ProductPriceVariationRepository $productPriceVariationRepo, FavoriteRepository $favoriteRepository, ProductReviewRepository $productReviewRepo)
    {
        //parent::__construct();
        $this->productRepository = $productRepo;
        $this->uploadRepository = $uploadRepo;
        $this->marketRepository = $marketRepo;
        $this->categoryRepository = $categoryRepo;
        $this->inventoryRepository = $inventoryRepo;
        $this->customerGroupRepository = $customerGroupRepo;
        $this->productPriceVariationRepository = $productPriceVariationRepo;
        $this->uomRepository = $uomRepo;
        $this->favoriteRepository = $favoriteRepository;
        $this->productReviewRepository = $productReviewRepo;
    }

    public function getProductDetails(Request $request) {
        //Get product by bar_code
        $id = $request->product_id;
        $product = $this->productRepository->where('bar_code',$id)->first();
        return json_encode($product);
    }

    public function getProductDetailsbyID(Request $request) {
        //Get product by id
        $id = $request->product_id;
        $product = $this->productRepository->where('id',$id)->first();
        return json_encode($product);
    }

    public function updateInventory(Request $request) {
        //$customFields = $this->customFieldRepository->findByField('custom_field_model', $this->productRepository->model());

        $product       = $this->productRepository->findWithoutFail($request->product_id);
        $current_stock = floor($product->stock);


        $input = array(
            'inventory_track_category'          => 'added_stock',
            'inventory_track_type'              => $request->stock_type,
            'inventory_track_date'              => date('Y-m-d'),
            'inventory_track_product_id'        => $request->product_id,
            'inventory_track_product_quantity'  => $request->quantity
        );

        try {
            //Store Inventory data
            $inventory = $this->inventoryRepository->create($input);
            if($inventory) {
                
                if($request->stock_type=='add') {
                    $new_stock =  $request->quantity + $current_stock;
                } elseif($request->stock_type=='reduce') {
                    $new_stock =  $request->quantity + $current_stock;
                }
                //echo $new_stock; exit();
                $product = DB::table('products')->where('id',$request->product_id)->update(['stock' => $new_stock]);
            }
            /*$product->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid){
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($product, 'image');
                }
            }*/
            Flash::success(__('lang.saved_successfully', ['operator' => __('lang.stock')]));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        return redirect(route('products.index'));
    }

    public function getStockdetails(Request $request) {
        $product_id          = $request->product_id;
        $start_date          = $request->start_date;
        $end_date            = $request->end_date;
        if($request->ajax()) {

            $data = InventoryTrack::select(
                'inventory_track.id',
                'inventory_track.inventory_track_date',
                'inventory_track.inventory_track_category',
                'inventory_track.inventory_track_type',
                'inventory_track.inventory_track_product_quantity'
            )->where('inventory_track_product_id',$product_id);
            /*if($start_date!='' & $end_date!='') {
                $data->whereBetween('inventory_track.inventory_track_date', [$start_date, $end_date]);
            }*/
            $datas = $data->get();
            $product = $this->productRepository->findWithoutFail($request->product_id);
            $stocks[] = 0;
            for($i=0; $i<count($datas); $i++) {
               
               if($datas[$i]->inventory_track_type=='add') {
                    $stock = array_sum($stocks) + $datas[$i]->inventory_track_product_quantity;
               } else if($datas[$i]->inventory_track_type=='reduce') {
                    $stock = array_sum($stocks) - $datas[$i]->inventory_track_product_quantity;
               }
               $datas[$i]->inventory_closing_stock  = $stock.' '.$product->unit; 
               $datas[$i]->inventory_track_category = ucfirst(str_replace("_"," ",$datas[$i]->inventory_track_category));
               ($datas[$i]->inventory_track_type=='add') ? $operator='' : $operator='-';
               $datas[$i]->quantity                 = $operator.$datas[$i]->inventory_track_product_quantity.' '.$product->unit;
               unset($stocks);
               $stocks[] = $stock;
            }
            //dd($datas->reverse());
            return Datatables::of($datas->reverse())->make(true);

        }
    }


    //Price Variations

    public function createProductPrice(Request $request)
    {
       $input = $request->all();
       $res = array();
       foreach ($input['customer_group_id'] as $key => $value) {
          $customer_groups = DB::table('customer_groups')->where('id', $value)->pluck('name');
          foreach ($customer_groups as $name => $customer_group_name) {
              
            $res[]= '<div class="form-group row ">
                        <label for="product_price[]" class="col-3 control-label text-right">'.$customer_group_name.' (Price)</label>
                        <div class="col-9">
                            <input name="product_price[]" type="number" step="any" min="0" value="" class="form-control"/>
                        </div>
                    </div>';

           }
       }
       return response()->json(['success'=>$res]);
    }

    public function updateProductPrice(Request $request)
    {
        $input = $request->all();
        $res = array();

        if(isset($input['customer_group_id'])) {
        $product_id = $input['product_id'];
      
            foreach ($input['customer_group_id'] as $key => $id_val) {
              $customer_groups = DB::table('customer_groups')->where('id', $id_val)->pluck('name');
                foreach ($customer_groups as $name => $customer_group_name) {
               
                    $product_price = DB::table('product_group_price')->where('customer_group_id', $id_val)->where('product_id', $product_id)->pluck('product_price')->first();
                    $res[]= '<div class="form-group row ">
                                <label for="product_price[]" class="col-3 control-label text-right">'.$customer_group_name.'</label>
                                <div class="col-9">
                                    <input name="product_price[]" type="number" step="any" min="0" value="'.$product_price.'" class="form-control"/>
                                </div>
                            </div>';
                }
            }                
        }
    
        return response()->json(['success'=>$res]);
    }
    //Price Variations

    //Print Bar Codes
    public function printBarCodes($id) {
        $product   = $this->productRepository->findWithoutFail($id);
        $pdf = PDF::loadView('products.product_bar_codes', compact('product'));
        $filename = $id.'-'.$product->bar_code.'-'.$product->name.'-barcodes.pdf';
        return $pdf->stream($filename);
    }
    //Print Bar Codes


    public function getPriceVariations(Request $request) {
        $product_id       = $request->product_id;
        $price_variations = DB::table('product_price_variation')->where('product_id',$product_id)->get();
        if(count($price_variations) > 0) {
            $output = array('status' => 'success', 'message' => 'Data Fetched Successfully', 'result_data' => $price_variations);
        } else {
            $output = array('status' => 'success', 'message' => 'Data Fetched Successfully', 'result_data' => array());
        }
        echo json_encode($output);
    }




    public function addToCart(Request $request) {
        
        $id        = $request->product_id;
        $type      = $request->type;
        $variation = $request->variation;
        $quantity  = ($request->quantity) ? $request->quantity : 1 ;
        
        //Validate type 1 - add or 0 remove
        if($type==1) {
            

            $product = $this->productRepository->where('id',$id)->first();
            (Cart::get($product->id.'-'.$variation)) ? $newQuantity = Cart::get($product->id.'-'.$variation)->quantity + $quantity  : $newQuantity = $quantity;

            if($product->stock >= $newQuantity) {

                if($product->discount_price > 0) {
                    $product->price = $product->discount_price;
                }
                
                if($variation==$product->secondary_unit) {
                    $product->price =  $product->price / $product->conversion_rate;   
                }

                $saleCondition = new \Darryldecode\Cart\CartCondition(array(
                    'name'   => 'GST '.$product->tax.'%',
                    'type'   => 'tax',
                    'value'  => '+'.$product->tax.'%'
                ));

                $options = array(
                    'product_image' => ($product->hasMedia('image')) ?  $product->getFirstMediaUrl('image','thumb') : '' ,
                    'unit'          => $variation,
                    'id'            => $product->id
                );

                $product_data = array(
                    'id'         => $product->id.'-'.$variation,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'quantity'   => $quantity,
                    'attributes' => $options,
                    'conditions' => $saleCondition
                );
                Cart::add($product_data);

                $status  = 'success';
                $message = 'Item added to cart successfully.';

            } else {
                $status  = 'faliure';
                $message = 'Item Out of stock successfully. Please select below '.$product->stock;
            }

        } else {
            if(Cart::get($id)->quantity > 1) {
                Cart::update($id, array('quantity' => -1));
                $status  = 'success';
                $message = 'Item added to cart successfully.';
            } else {
                Cart::remove($id);
                $status  = 'success';
                $message = 'Item removed from cart successfully.';
            }
        }
        
        if(Cart::getTotalQuantity() > 0) {
            //Contribution
                $contribution_data = new \Darryldecode\Cart\CartCondition(array(
                    'name'   => 'Charity Contribution',
                    'type'   => 'contribution',
                    'target' => 'total',
                    'value'  => '+'.(setting('app_charity_contribution') * count(Cart::getContent()) ),
                    'order'  => 2
                ));
                Cart::condition($contribution_data);
            //Contribution
        }
        
        $output = array('status' => $status, 'message' => $message);
        return json_encode($output);
    }





    public function addItemToCart(Request $request) {
        $id   = $request->product_id;
        $qty  = $request->quantity;
        
        $product = $this->productRepository->where('id',$id)->first();
        if($product->discount_price > 0) {
            $product->price = $product->discount_price;
        }

        $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name'   => 'GST '.$product->tax.'%',
            'type'   => 'tax',
            'value'  => '+'.$product->tax.'%'
        ));

        $options = array(
            'product_image' => $product->media[0]->thumb,
            'unit'          => $product->unit
        );

        $product_data = array(
            'id'         => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'quantity'   => $qty,
            'attributes' => $options,
            'conditions' => $saleCondition
        );
        Cart::add($product_data);

        $output = array('message' => 'Item added to cart successfully.');
        return json_encode($output);
    }

    
    public function cartItems() {
        if(Cart::getTotalQuantity() > 0) {

          $cart_items = Cart::getContent();
          foreach ($cart_items as $key => $value) {
            $cart_items[$key]->total = Cart::get($value->id)->getPriceSum();
          }
          $output = array(
            'status'           => 'success', 
            'message'          => 'Fetched Successfully', 
            'cart_items'       => $cart_items,
            'cart_total_items' => Cart::getTotalQuantity(),
            'cart_subtotal'    => Cart::getSubTotal(),
            'cart_total'       => Cart::getTotal(),
          );

        } else {
          $output = array(
            'status'           => 'success', 
            'message'          => 'Fetched Unsuccessfully', 
            'cart_items'       => array(),
            'cart_total_items' => 0,
            'cart_subtotal'    => 0,
            'cart_total'       => 0,
          );
        }
        return json_encode($output);
    }



    public function removeCartItem(Request $request) {
        $id = $request->product_id;
        Cart::remove($id);
        
        if(Cart::getTotalQuantity() > 0) {
            //Contribution
                $contribution_data = new \Darryldecode\Cart\CartCondition(array(
                    'name'   => 'Charity Contribution',
                    'type'   => 'contribution',
                    'target' => 'total',
                    'value'  => '+'.(setting('app_charity_contribution') * count(Cart::getContent()) ),
                    'order'  => 2
                ));
                Cart::condition($contribution_data);
            //Contribution
        }
        
        if(Cart::getTotalQuantity() == 0) {
            //If Cart empty remove all the conditions and payments
            Cart::clear();
            Cart::clearCartConditions();    
        }    
        $output = array('status' => 'success');
        return response()->json($output); //json_encode($output);
    }

    public function loadSidbarCart() {
      return view('layouts.cart_widget');
    }

    public function loadCartTotal() {
      return view('layouts.cart_total_widget');
    }
    
    public function addToFavorite(Request $request)  {
        $product_id = $request->product_id;
        $user_id    = auth()->id();
        
        $favorites  = $this->favoriteRepository->where('product_id',$product_id)->where('user_id',$user_id)->get();
        //Validate Exisit in favorites
        if(count($favorites) == 0) {
            $input = array(
                'product_id' => $product_id,
                'user_id'    => $user_id
            );
            $favorites = $this->favoriteRepository->create($input);
            $message   = 'Added to wishlist';
        } else {
            $this->favoriteRepository->where('product_id',$product_id)->where('user_id',$user_id)->delete();
            $message   = 'Wishlist item removed';    
        }
        $count = count($this->favoriteRepository->where('user_id',$user_id)->get());
        Cookie::queue('favourites', $count, 60);
        return response()->json(['status'=>'success', 'message'=>$message, 'data'=>$count]);
    }

    public function storeReview(Request $request) {
        $review_data = array(
          'review'     => $request->review,
          'rate'       => $request->rating,
          'user_id'    => auth()->id(),
          'product_id' => $request->product_id,
          'active'     => 0
        );
        //Store Review Datas
        $review = $this->productReviewRepository->create($review_data);
        //Flash::success(__('lang.saved_successfully', ['operator' => __('lang.product')]));
        return redirect()->back()->with('message','Your reveiew posted successfully!. Waiting for Approval!');
    }
  

  
    
}
