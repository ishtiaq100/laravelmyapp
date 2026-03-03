<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display all ideas of logged-in user
     */
    public function index()
    {
        $ideas = Auth::user()
            ->ideas()
            ->with('steps')
            ->latest()
            ->get();

        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show create idea form
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store new idea
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'links'       => ['nullable', 'string'], // accept string
            'status'      => ['required'],
        ]);

        // Convert comma-separated links string to array
        $links = !empty($validated['links'])
            ? array_map('trim', explode(',', $validated['links']))
            : [];

        $idea = Auth::user()->ideas()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'links'       => $links,
            'status'      => $validated['status'],
        ]);

        return redirect()
            ->route('ideas.show', $idea)
            ->with('success', 'Idea created successfully.');
    }

    /**
     * Show single idea with steps
     */
    public function show(Idea $idea)
    {
        $this->authorizeIdea($idea);

        $idea->load('steps');

        return view('ideas.show', compact('idea'));
    }

    /**
     * Show edit form
     */
    public function edit(Idea $idea)
    {
        $this->authorizeIdea($idea);

        return view('ideas.edit', compact('idea'));
    }

    /**
     * Update idea
     */
    public function update(Request $request, Idea $idea)
    {
        $this->authorizeIdea($idea);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'links'       => ['nullable', 'string'], // accept string
            'status'      => ['required'],
        ]);

        // Convert comma-separated links string to array
        $links = !empty($validated['links'])
            ? array_map('trim', explode(',', $validated['links']))
            : [];

        $idea->update([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'links'       => $links,
            'status'      => $validated['status'],
        ]);

        return redirect()
            ->route('ideas.show', $idea)
            ->with('success', 'Idea updated successfully.');
    }

    /**
     * Delete idea (steps auto-deleted if FK cascade is set)
     */
    public function destroy(Idea $idea)
    {
        $this->authorizeIdea($idea);

        $idea->delete();

        return redirect()
            ->route('ideas.index')
            ->with('success', 'Idea deleted successfully.');
    }

    /* =======================================================
        STEPS MANAGEMENT
    ======================================================= */

    /**
     * Store new step
     */
    public function storeStep(Request $request, Idea $idea)
    {
        $this->authorizeIdea($idea);

        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);

        $idea->steps()->create($validated);

        return back()->with('success', 'Step added successfully.');
    }

    /**
     * Update step (mark complete / rename)
     */
    public function updateStep(Request $request, Step $step)
    {
        $this->authorizeIdea($step->idea);

        $validated = $request->validate([
            'description'     => ['sometimes', 'string', 'max:255'],
            'completed' => ['sometimes', 'boolean'],
        ]);

        $step->update($validated);

        return back()->with('success', 'Step updated.');
    }

    /**
     * Delete step
     */
    public function destroyStep(Step $step)
    {
        $this->authorizeIdea($step->idea);

        $step->delete();

        return back()->with('success', 'Step removed.');
    }

    /**
     * Ensure idea belongs to logged-in user
     */
    protected function authorizeIdea(Idea $idea): void
    {
        abort_if($idea->user_id !== Auth::id(), 403);
    }
}