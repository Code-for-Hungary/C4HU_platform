@extends('layouts.app')
@section('content')
<div id="projectForm">
	    	@include('popup')
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
				@if (count($errors) > 0)
				   <div class = "alert alert-danger">
				      <ul>
				         @foreach ($errors->all() as $error)
				            <li>{{ __('project.'.$error) }}</li>
				         @endforeach
				      </ul>
				   </div>
				@endif            
            	<h3>{{ __('project.project') }}</h3>
            	<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="#">{{ __('project.info') }}</a>
					</li>
  					<li class="nav-item">
  						<a class="nav-link" href="{{ \URL::to('/contributors/'.$project->id) }}">{{ __('project.contributors') }}</a>
  					</li>
				</ul>
                <div class="projectForm">
                	<form method="POST" action="{{ \URL::to('/project') }}" id="frmProject">
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}" />
                        <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" />
	                    <div class="form-group">
                            <img class="avatar" src="{{ $project->avatar }}" />
	                    </div>
	                    <div class="form-group">
                            <label>
                               {{ __('project.name') }}
                            </label>
                            <input type="text" class="form-control" name="name" 
                            size="80" value="{{ $project->name }}" />
                        </div>
	                    <div class="form-group">
                            <label>
                               {{ __('project.avatar') }}
                            </label>
                            <input type="text" class="form-control" name="avatar" 
                                size="80" value="{{ $project->avatar }}" />
                        </div>
	                    <div class="form-group">
                            <label>
                                {{ __('project.organisation') }}
                            </label>
                            <input type="text" class="form-control" name="organisation" 
                                size="80" value="{{ $project->organisation }}" />
                        </div>
	                    <div class="form-group">
                            <label>
                               {{ __('project.website') }}
                            </label>
                            <input type="text" class="form-control" name="website" 
                                size="80" value="{{ $project->website }}" />
                        </div>
	                    <div class="form-group">
                            <label>
                                {{ __('project.deadline') }}
                            </label>
                            <input type="text" class="form-control" name="deadline" 
                                size="80" value="{{ $project->deadline }}" />
                        </div>
	                    <div class="form-group">
                                <label>
                                        {{ __('project.status') }}
                                </label>
                                <select class="form-control" name="status" id="status">
                                	<option value="plan">{{ __('project.plan') }}</option>
                                	<option value="task">{{ __('project.task') }}</option>
                                	<option value="inprogress">{{ __('project.inprogress') }}</option>
                                	<option value="suspended">{{ __('project.suspended') }}</option>
                                	<option value="canceled">{{ __('project.canceled') }}</option>
                                	<option value="closed">{{ __('project.closed') }}</option>
                                </select> 
                            </div>
                        </div>

	                    <div class="form-group">
                            <label>
                                   {{ __('project.description') }}
                            </label>
                            <textarea cols="80" rows="10" class="form-control" name="description">{{ $project->description }}</textarea>  
                        </div>

                        <div class="skillsBlock">
			                <div class="row">
				                <h3>{{ __('project.skills') }}</h3>
			                </div>
			                <div class="row">
				                <div class= "col-sm-6" id="skillsTree"></div>
				                <div class= "col-sm-6" id="skillLevels"></div>
			                </div>
		                </div>
	                    <div class="form-group">
	                    	<button type="button" class="btn btn-primary" id="btnSave">
	                    		<em class="fa fa-check"></em>
	                    		{{ __('project.save') }}
	                    	</button>
						</div>
						<input type="hidden" id="skills" name="skills" value='{!! $skills !!}' />					
                    </form>
                </div>
        </div>
        <script src="/js/tree.js"></script>
        <script type="text/javascript">
        $(function() {
        	// JQuery onload
        	
        	// status select beállítása
        	$('#status').val('{{ $project->status }}');
        	
			// {az aktuális user képességei skillId:skillLevel, ....}
        	var skills = JSON.parse($('#skills').val());
        	
       		/* 
       		* skilss objektum kialakitása a skillTre és aképernyőn lévő adatokból,
       		* beirása a rejtett input mezőbe
       		*/
        	setSkillsFromScreen = function() {
        		if (skillTree) {
					skills = {};
				    for(i = 0; i < skillTree.values.length; i++) {
				    	let value = skillTree.values[i];
			    		skills[value] = '';
					}			
					$('#skills').val(JSON.stringify(skills));
				}
        	};
        	
			/**
			* btnSave click - skills rejtett input mező feltöltése, form submit
			*/
        	$('#btnSave').click(function() {
					setSkillsFromScreen();
					$('#frmProject').submit();
        	});
        	
			// skills objektumból values array-t képez        	
        	let valuesArray = [];
		    for (const [key, value] of Object.entries({!! $skills!!})) {
		    	valuesArray.push(key);
        	}

        	// skill fa megjelenitő init
        	var skillTree = new Tree('#skillsTree', {
                		data: {!! $skillsTree !!},
                		closeDepth:1,
                		values: valuesArray,
                		onChange: function() {
						    var i = 0;
					    	setSkillsFromScreen();
						    $('#skillLevels').html('');
						    for(i = 0; i < this.values.length; i++) {
						    	let node = this.nodesById[this.values[i]];
						    	let p = '<var>'+node.text+'</var>, ';
						    	$('#skillLevels').append(p);
						    } 
  						},
                	});
                });	
         </script>       	
</div>
@endsection
