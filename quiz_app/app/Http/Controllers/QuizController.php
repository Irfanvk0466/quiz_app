<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    protected $apiService;

    public function __construct(APIService $apiService)
    {
        $this->apiService = $apiService;
    }
    /**
     * Check if the provided answer is correct.
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAnswer(Request $request)
    {
        $questionId = $request->input('question_id');
        $answer = $request->input('answer');
        $category = $request->input('category');
        $question = $request->input('question');
        $questions = $this->getQuestionById($questionId);
        if (!$questions) {
            return $this->errorResponse('Question not found.', 404);
        }
        $is_correct = $this->checkIfAnswerIsCorrect($answer, $questions['correctAnswer']);
        return $this->successResponse($is_correct, $questions['correctAnswer'], $question, $category);
    }
    /**
     * Fetch question details from the external API using the question ID.
     *
     * @param  int  $questionId
     * @return array|null
     */
    private function getQuestionById($questionId)
    {
        return $this->apiService->fetchQuestionById($questionId);
    }
    /**
     * Check if the provided answer is correct by comparing it with the correct answer.
     *
     * @param  string  $answer
     * @param  string  $correctAnswer
     * @return int  Returns 1 if correct, 0 if incorrect
     */
    private function checkIfAnswerIsCorrect($answer, $correctAnswer)
    {
        return (strtolower($answer) === strtolower($correctAnswer)) ? 1 : 0;
    }
    /**
     * Return a success response with the result of the answer check.
     *
     * @param  int  $is_correct  
     * @param  string  $correctAnswer  
     * @param  string  $question 
     * @param  string  $category
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($is_correct, $correctAnswer, $question, $category)
    {
        return response()->json([
            'is_correct' => $is_correct,
            'correct_answer' => $correctAnswer,
            'question' => $question,
            'category' => $category,
            'message' => $is_correct ? 'Correct answer!' : 'Incorrect answer.'
        ]);
    }
    /**
     * Return an error response when something goes wrong.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse($message, $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }
    /**
     * Handle the submission of quiz answers.
     *
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitQuiz(Request $request)
    {
        $answers = $request->input('answers');
        $percentage = $request->input('percentage');
        $resultMessage = $request->input('resultMessage');
        $userId = Auth::id(); 
        Session::put('quiz_results', [
            'user_id' => $userId,
            'answers' => $answers,
            'percentage' => $percentage,
            'resultMessage' => $resultMessage,
        ]);
        return response()->json(['category' => $answers[0]['category']]);
    }
    /**
     * Show the result of the quiz.
     *
     * 
     * @param  string  $category
     * @return \Illuminate\View\View
     */
    public function showResult($category)
    {
        $results = Session::get('quiz_results');
        $userId = $results['user_id'];
        return view('student.result', [
            'answers' => $results['answers'],
            'percentage' => $results['percentage'],
            'resultMessage' => $results['resultMessage'],
            'category' => $category,
            'user_id' => $userId,
        ]);
    }
}

