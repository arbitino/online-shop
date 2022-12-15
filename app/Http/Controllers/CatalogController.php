<?php

namespace App\Http\Controllers;

use App\View\ViewModels\CatalogViewModel;
use Domain\Catalog\Models\Category;

class CatalogController extends Controller
{
	public function index(?Category $category): CatalogViewModel
	{
		return (new CatalogViewModel($category))
			->view('catalog.index');
	}
}
