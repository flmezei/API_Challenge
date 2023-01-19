<?php

namespace App\Http\Controllers;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderCreateRequest;
use App\Mail\OrderCreated;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Validators\OrderValidator;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var OrderProductRepository
     */
    protected $orderProductRepository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $repository
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $repository, CustomerRepository $customerRepository, ProductRepository $productRepository, OrderProductRepository $orderProductRepository, OrderValidator $validator)
    {
        $this->repository = $repository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orders = $this->repository->with('products.product')->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $orders,
            ]);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $order = $this->repository->create([
                'customer_id' => $request->get('customer_id'),
            ]);

            if (!$order) {
                return response()->json([
                    'error'   => true,
                    'message' => 'An error occurred while creating the order.'
                ]);
            }

            $totalPrice = 0;
            foreach ($request->input('products') as $product) {
                $_product = $this->productRepository->find($product['product_id']);
                $this->orderProductRepository->create([
                    'order_id' => $order->id,
                    'product_id' => $_product->id,
                    'quantity' => $product['quantity'],
                    'price' => $_product->price,
                ]);
                $totalPrice += $_product->price * $product['quantity'];
            }

            $this->repository->update([
                'total_price' => $totalPrice,
            ], $order->id);

            // Send mail
            $customer = $this->customerRepository->find($request->get('customer_id'));
            Mail::to($customer->email)->send(
                new OrderCreated(
                    $this->repository->with(['customer', 'products.product'])->find($order->id)
                )
            );

            $response = [
                'message' => 'Order created.',
                'data'    => $order->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->repository->with('products.product')->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $order,
            ]);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Order deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Order deleted.');
    }
}
