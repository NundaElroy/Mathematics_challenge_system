<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Challenge;

class PageController extends Controller
{
    /**
     * Display the specified page.
     *
     * @param  string  $page
     * @return \Illuminate\View\View
     */
    public function index($page)
    {
        switch ($page) {
            case 'schools':
                return $this->schools();
            case 'challenges':
                return $this->challenges();
            case 'upload-questions-answers':
                return $this->uploadQuestionsAnswers();
            // Add other cases here for different pages
            default:
                return $this->defaultPage($page);
        }
    }

    /**
     * Display the list of schools.
     *
     * @return \Illuminate\View\View
     */
    protected function schools()
    {
        $schools = School::all();
        $title = "Schools"; // Define the title
        $activePage = 'schools'; // Define the active page
        return view('pages.schools', compact('schools', 'title', 'activePage'));
    }

    /**
     * Display the list of challenges.
     *
     * @return \Illuminate\View\View
     */
    protected function challenges()
    {
        $challenges = Challenge::all();
        $title = "Challenges"; // Define the title
        $activePage = 'challenges'; // Define the active page
        return view('pages.challenges', compact('challenges', 'title', 'activePage'));
    }

    /**
     * Display the upload questions and answers form.
     *
     * @return \Illuminate\View\View
     */
    protected function uploadQuestionsAnswers()
    {
        $title = "Upload Questions and Answers"; // Define the title
        $activePage = 'upload-questions-answers'; // Define the active page
        return view('pages.questions', compact('title', 'activePage'));
    }

    /**
     * Display a default page.
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    protected function defaultPage($page)
    {
        $title = ucfirst($page); // Define the title
        $activePage = $page; // Define the active page
        // Check if the view exists before returning it
        if (view()->exists('pages.' . $page)) {
            return view('pages.' . $page, compact('title', 'activePage'));
        }

        // If the view doesn't exist, return a 404 page or a default view
        abort(404, 'Page not found');
    }
}
