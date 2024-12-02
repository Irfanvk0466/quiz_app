<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\APIService;
use App\Helpers\PaginationHelper;




class CategoryController extends Controller
{
    protected $apiService;
    protected $paginationHelper;


    public function __construct(APIService $apiService, PaginationHelper $paginationHelper)
    {
        $this->apiService = $apiService;
        $this->paginationHelper = $paginationHelper;

    }
    /**
     * To list categories.
     * 
     * @return array
     */
    public function listCategories(Request $request) 
    {
        $categories = $this->apiService->fetchCategories();
        $pagedCategories = $this->paginationHelper->paginateData($categories, $request);
        return view('student.category', compact('pagedCategories'));
    }
    /**
     * To list Question Based on a Category.
     * 
     * @param $category
     * @return array
     */
    public function showQuestions($category)
    {
        $questions = $this->apiService->fetchQuestionsByCategory($category);
        return view('student.quiz', compact('questions'));
    }
     
}
