<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
//  Illuminate\Contracts\Validation\Rule ------>  da problemi con Rule::unique
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    protected $validateRules =
    [
        'title' => 'required|min:3|max:150|unique:projects',
        // 'author'=> 'min:3|max:50',
        'content' => 'required|min:5|max:1600',
        'project_date_start' => 'required',
        'image' => 'required|image',
        'type_id'=>'required|exists:types,id',

    ];
    protected $validateMessages = [
        'title.required' => 'Titolo obbligatorio',
        'title.min' => 'Minimo 3 caratteri',
        'title.max' => 'Limite massimo 50 caratteri',
        // 'author.min' => 'Minimo 3 caratteri' ,
        // 'author.max' => 'Limite massimo 50 caratteri' ,
        'content.required' => 'Contenuto obbligatorio',
        'content.min' => 'Minimo 5 caratteri',
        'content.max' => 'Limite massimo 1660 caratteri',
        'project_date_start.required' => 'Data inizio obbligatoria',
        'image.require' => 'immagine necessaria',
        'image.image' => 'Controlla che sia un immagine',
        'type_id.require'=>'Tipo progetto obbligatorio',
    ];




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(25);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create', ["project" => new Project(),'types'=>Type::all() ]);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //  dd( $request->all());
        $data =  $request->all();
        $request->validate($this->validateRules, $this->validateMessages);
        // dd($data);
        $data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = Storage::put('imgs/', $data['image']);
        //$data['project_date_end']= ($data['project_date_start']);
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();
        return redirect()->route('admin.projects.show', $newProject->id)->with('message', "Project \" $newProject->title \" has been Created")->with('classMessage', "-success");

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //dd($project);
        // $projects = Project::paginate();
        $nextProject = Project::where('id', '>', $project->id)->first();
        $previousProject = Project::where('id', '<', $project->id)->orderBy('id', 'DESC')->first();
        return view('admin.projects.show', compact('project', 'nextProject', 'previousProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', ["project" => $project,'types'=>Type::all() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {


        $newValidateRules = $this->validateRules;
        $newValidateRules['title'] = ['required', 'min:5', 'max:150', Rule::unique('projects')->ignore($project->id)];

        $data = $request->validate($newValidateRules, $this->validateMessages);

        $project->update($data);
        return redirect()->route('admin.projects.show', compact('project'))->with('message', "Project \" $project->title \" has been edit")->with('classMessage', "-success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Project \" $project->title \" has been deleted")->with('classMessage', "-danger");
    }
}
