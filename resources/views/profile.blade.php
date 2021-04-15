@extends('layouts.app')
@section('content')
<div id="profileForm">
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
		    	@include('popup')
				@if (count($errors) > 0)
				   <div class = "alert alert-danger">
				      <ul>
				         @foreach ($errors->all() as $error)
				            <li>{{ __('profile.'.$error) }}</li>
				         @endforeach
				      </ul>
				   </div>
				@endif            
            	<h3>{{ __('profile.profile') }}</h3>
            	<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="#">{{ __('profile.info') }}</a>
					</li>
  					<li class="nav-item">
  						<a class="nav-link" href="{{ \URL::to('/profileprojects/'.\Auth::user()->id) }}">{{ __('profile.linkedProjects') }}</a>
  					</li>
				</ul>
                <div class="profileForm">
                	<form method="POST" action="{{ \URL::to('/profilesave') }}" id="frmProfile">
	                    <div class="form-group">
	                    	{{ \Auth::user()->name }}
	                    	<img class="bigAvatar" src="{{ \Auth::user()->avatar }}" style="float:right" />
						</div>		            	
	                    <div class="form-group">
	                    	@if ($sysadmin == 1)
	                    	<strong></strong>{{ __('profile.sysadmin') }}</strong>
	                    	@endif
						</div>		            	
                        @csrf
	                    <div class="form-group">
                                <label>
                                        {{ __('profile.password') }}
                                </label>
                                <input type="password" class="form-control" name="password" 
                                size="80" value="" />
                            </div>
                        </div>
	                    <div class="form-group">
                                <label>
                                        {{ __('profile.password_repeat') }}
                                </label>
                                <input type="password" class="form-control" name="password2" 
                                size="80" value="" />
                            </div>
                        </div>
	                    <div class="form-group">
	                    	{{ __('profile.passwordhelp') }}
                        </div>


	                    <div class="form-group">
                                <label>
                                        {{ __('profile.avatar') }}
                                </label>
                                <input type="text" class="form-control" name="avatar" 
                                size="80" value="{{ \Auth::user()->avatar }}" />
                                <br />{{ __('profile.avatarhelp') }}
                            </div>
                        </div>
	                    <div class="form-group">
                                    <label>
                                        {{ __('profile.voluntary') }}
                                    </label>
	                                @if ($voluntary == 1) 
    	                            <input type="checkbox" name="voluntary" checked="checked" value="1"/>
        	                        @else
            	                    <input type="checkbox" name="voluntary" value="1" />
                	                @endif
                        </div>
	                    <div class="form-group">
                                    <label>
                                        {{ __('profile.project_owner') }}
                                    </label>
	                                @if ($project_owner == 1)
    	                            <input type="checkbox" name="project_owner" checked="checked" value="1"  />
        	                        @else
            	                    <input type="checkbox" name="project_owner" value="1" />
                	                @endif
                        </div>
	                    <div class="form-group">
                                <label>
                                        {{ __('profile.publicinfo') }}
                                </label>
                                <textarea cols="80" rows="10" class="form-control" name="publicinfo">{{ $publicinfo }}</textarea>  
                        </div>
                        <div class="skillsBlock">
			                <div class="row">
				                <div class= "col-sm-6">{{ __('profile.skills') }}</div>
				                <div class= "col-sm-6">{{ __('profile.skillLevels') }}</div>
			                </div>
			                <div class="row">
				                <div class= "col-sm-6" id="skillsTree"></div>
				                <div class= "col-sm-6" id="skillLevels"></div>
			                </div>
		                </div>
	                    <div class="form-group">
	                    	<button type="button" class="btn btn-primary" id="btnSave">
	                    		{{ __('profile.save') }}
	                    	</button>
						</div>
	                    <div class="form-group">
	                    	@if ($sysadmin == 1)
	                    	<a class="btn btn-secondary" href="{{ \URL::to('profilesysadmins') }}">
	                    		{{ __('profile.sysadmins') }}</a>
	                    	@else
	                    	<a  class="btn btn-danger" href="{{ \URL::to('profiledel') }}">
	                    		{{ __('profile.delete') }}</a>
	                    	@endif
						</div>
	                    <div class="form-group">
	                    	{{ __('profile.help') }}
						</div>	
						<input type="hidden" id="skills" name="skills" value='{!! $skills !!}' />					
                    </form>
                </div>
                <!-- skillLevel template -->
                <div style="display:none">
               		<p id="skillLevelTemplate">
		                	<label></label>
		                	<select>
		                		<option value="student">{{ __('profile.student') }}</option>
		                		<option value="junior">{{ __('profile.junior') }}</option>
		                		<option value="senior">{{ __('profile.senior') }}</option>
		                		<option value="mentor">{{ __('profile.mentor') }}</option>
		                	</select>
               		</p> 
               	</div>
            </div>
        <script src="js/tree.js"></script>
        <script type="text/javascript">
        $(function() {
        	// JQuery onload
        	
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
				    	if ($('#level_'+value+' select').val()) {
				    		skills[value] = $('#level_'+value+' select').val();
				    	}
					}			
					$('#skills').val(JSON.stringify(skills));
				}
        	};
        	
			/**
			* btnSave click - skills rejtett input mező feltöltése, form submit
			*/
        	$('#btnSave').click(function() {
					setSkillsFromScreen();
					$('#frmProfile').submit();
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
						    	let p = $('#skillLevelTemplate').clone();
						    	p.attr('id','level_'+this.values[i]);
						    	p.css('display','block');
						    	$('#skillLevels').append(p);
						    	let node = this.nodesById[this.values[i]];
						    	$('#level_'+this.values[i]+' label').html(node.text);
						    } 
						    for (const [key, value] of Object.entries(skills)) {
								if ($('#level_'+key)) {
									$('#level_'+key+' select').val(value);								
								}									  
							}
  						},
                	});
                });	
         </script>       	
</div>
@endsection