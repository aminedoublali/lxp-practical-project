<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Evaluation;

class ReviewController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
    ) {
        $this->customerRepo = $customerRepository;

        $this->middleware(['permission:update-order, guard:employee'], ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $evaluations = Evaluation::all();

        $evaluations = $evaluations->map(function ($item) {
            $item['customer_name'] = $this->customerRepo->findCustomerById($item['customer_id'])->name;
            return $item;
        });

        return view('admin.review.list', ['evaluations' => $evaluations]);
    }
}