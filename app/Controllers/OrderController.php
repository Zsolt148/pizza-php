<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;

class OrderController extends Controller
{
    protected $folder = 'orders';

	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$orders = Pizza::query()
			->raw("
				SELECT orders.*, pizzas.category_name AS pizcat_name, pizzas.is_vegetarian AS veg, categories.name AS cat_name, categories.price AS cat_price
				FROM orders
                INNER JOIN pizzas ON orders.pizza_name=pizzas.name
				INNER JOIN categories ON pizzas.category_name=categories.name
				ORDER BY orders.ordered_at
			");

		return $this->view('index', [
			'orders' => $orders
		]);
	}

	/**
	 * @return mixed
	 */
	public function create()
	{
		abort_if(!auth()->check());

		return $this->view('create');
	}

    /**
     * @param int $id
	 * @return mixed
	 */
    public function export(int $id)
    {
        $this->view('export');

        try
        {
            $order = Order::query()->findOrFail($id);
            $pizza = Pizza::query()->findOrFail('name', $order['pizza_name']);
            $category = Category::query()->findOrFail('name', $pizza['category_name']);

            // Include the main TCPDF library
            require_once('tcpdf/tcpdf.php');

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Pizza-php');
            $pdf->SetTitle('Order');
            $pdf->SetSubject('Downloaded order from Pizza-php');
            $pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Order, Pizza');

            // set default header data
            $pdf->SetHeaderData("pizza.png", 25, "Exported order", "Exported from Pizzas-php\n".date('Y.m.d',time()));

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set font
            $pdf->SetFont('helvetica', '', 10);

            // add a page
            $pdf->AddPage();

            // create the HTML content
            $html  = '
                <html>
                    <head>
                        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
                    </head>
                    <body>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Pizza name</th>
                                    <th scope="col" class="py-3 px-6">Category</th>
                                    <th scope="col" class="py-3 px-6">Vegetarian</th>
                                    <th scope="col" class="py-3 px-6">Price</th>
                                    <th scope="col" class="py-3 px-6">Amount</th>
                                    <th scope="col" class="py-3 px-6">Ordered</th>
                                    <th scope="col" class="py-3 px-6">Delivered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <span class="td-content">'. $order['pizza_name'] .'</span>
                                    </th>
                                    <td class="py-4 px-6">
                                        <span class="td-content">'. $pizza['category_name'] .'</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="td-content">
            ';
            if($pizza['is_vegetarian'] == 0)
                $html .='
                                            Not vegeterian
                ';
            else
                $html .='
                                            Vegeterian
                ';
            $html .='
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="td-content">'. $category['price'] .'</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="td-content">'. $order['amount'] .'</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="td-content">'. $order['ordered_at'] .'</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="td-content">'. $order['delivery_at'] .'</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <body>
                </html>
            ';

            $pdf->writeHTML($html, true, false, true, false, '');

            //Close and output PDF document
            $pdf->Output('order'.date('Y.m.d',time()).'.pdf', 'I');
        }
        catch(Exception $e)
        {
			return $this->view('orders.export', [
				'errors' => $e->getMessage()
			]);
		}

        return redirect(route($this->routes->get('orders')), 'Successfully exported');
    }

    /**
	 * @return array
	 */
	private function rules()
	{
		return [
			'pizza_name' => ['required', 'string'],
			'amount' => ['required'],
            'ordered_at' => ['required'],
            'delivery_at' => ['required']
		];
	}
}