<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

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
