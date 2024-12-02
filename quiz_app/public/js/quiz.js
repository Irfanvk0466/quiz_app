let currentQuestion = 0;
const questions = $('.question');
const totalQuestions = questions.length;
let marks = 0;
let answers = [];

// Function to move to the next question
function nextQuestion() {
    if (currentQuestion < totalQuestions - 1) {
        $(questions[currentQuestion]).hide();
        currentQuestion++;
        $(questions[currentQuestion]).show();
        updateQuestionCount();
        resetTimer();
    } else {
        showSubmitButton();
    }
    if (currentQuestion === 14) {
        showSubmitButton();
    }
}

// Function to update the current question count
function updateQuestionCount() {
    $('#question-number').text(currentQuestion + 1);
}

// Countdown timer for each question
let countdown = 30;
const countdownElement = $('#countdown');
let timerInterval = setInterval(function() {
    if (countdown > 0) {
        countdown--;
        countdownElement.text(countdown);
    } else {
        nextQuestion();
    }
}, 1000);

// Reset the countdown timer
function resetTimer() {
    countdown = 30;
    countdownElement.text(countdown);
    clearInterval(timerInterval);
    timerInterval = setInterval(function() {
        if (countdown > 0) {
            countdown--;
            countdownElement.text(countdown);
        } else {
            nextQuestion();
        }
    }, 1000);
}

// Reset the quiz
function resetQuiz() {
    clearInterval(timerInterval);
    window.location.href = '/categories';
}

// Show the submit button after the last question
function showSubmitButton() {
    $('.next-button').hide();
    $('.reset-button').hide();
    $('#submit-button').show();
}

// function to check answer
function checkAnswer(button) {
    const parentOptions = $(button).parent();
    const previouslyClicked = parentOptions.find('.option-button.clicked');

    if (button === previouslyClicked[0]) {
        return;
    }
    parentOptions.find('.option-button').removeClass('clicked');
    button.classList.add('clicked');

    const answer = button.getAttribute('data-answer');
    const questionId = button.getAttribute('data-question-id');
    const category = button.getAttribute('data-category');
    const question = button.getAttribute('data-question');

    // Send AJAX request
    $.ajax({
        url: '/check-answer',
        method: 'POST',
        data: {
            question_id: questionId,
            answer: answer,
            category: category,
            question: question,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            answers = answers.filter(ans => ans.questionId !== questionId);
            answers.push({
                questionId: questionId,
                question: question,
                selectedAnswer: answer,
                correctAnswer: response.correct_answer,
                category: category,
                isCorrect: response.is_correct
            });
            if (response.is_correct === 1) {
                marks++;
            }
        },
        error: function (error) {
            console.error('Error verifying answer:', error);
        }
    });
}

// function to submit quiz
function submitQuiz() {
    const hasAttempted = answers.length > 0;

    if (!hasAttempted) {
        alert("Please attempt at least one question before submitting!");
        return;
    }

    const percentage = Math.round((marks / totalQuestions) * 100);
    let resultMessage;

    if (percentage >= 60) {
        resultMessage = 'Winner';
    } else if (percentage >= 40) {
        resultMessage = 'Better';
    } else {
        resultMessage = 'Failed';
    }

    const data = {
        answers: answers,
        percentage: percentage,
        resultMessage: resultMessage,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    $.ajax({
        url: '/result',
        method: 'POST',
        data: data,
        success: function (response) {
            window.location.href = `/result/${response.category}`;
        },
        error: function (error) {
            console.error('Error submitting quiz:', error);
        }
    });
}


