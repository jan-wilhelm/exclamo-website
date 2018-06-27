@extends('layouts/app')

@section('content')
	@exclamoflexsection (["classes" => "bg-color-primary-1 text-white"])
		<h4>@lang('messages.createcase')</h4>
		
		<form id="case-form" method="post" class="form" role="form" action="{{ route('incidents.store') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">
					@lang('messages.casetitle')
				</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="@lang('placeholders.casetitle')">
			</div>

			<div class="form-group">
				<label for="message">
					@lang('messages.casedescription')
				</label>
				<textarea class="form-control" id="message" name="message"></textarea>
			</div>
			<div class="input-group">
				<div id="mentor-select-div" class="form-group col-md-6">
					<label for="message">
						@lang('messages.mentorsselect')
					</label>
					<select id="mentor-select" class="d-none" id="mentors" name="mentors[]" multiple>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="category">
						@lang('messages.categoryselect')
					</label>
					<select id="category-select" class="form-control" id="category" name="category">
					@for ($i = 0; $i < sizeof(config('exclamo.categories', [])); $i++)
						<option value="{{ $i }}">{{ ucwords(config('exclamo.categories')[$i]) }}</option>
					@endfor
					</select>
				</div>
			</div>

			<div class="form-group text-center justify-content-center">
				<button type="submit" class="btn btn-primary">
					<i class="far fa-check-circle"></i>
					@lang('messages.createbutton')
				</button>
			</div>
		</form>
		{{ $errors }}
	@endexclamoflexsection
@endsection

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {

			$('#mentor-select-div').dropdown({
				multipleMode: 'label',
				input: '<input type="text" maxLength="100" placeholder="@lang("placeholders.search")">',
				data: [
					@foreach (auth()->user()->school->users()->mentor()->mentoring()->get() as $mentor)
						{!! json_encode(["id" => $mentor->id, "name" => $mentor->fullName()]) !!},
					@endforeach
				],
				searchable: true,
			});

			$('#case-form').submit(function(event) {
				event.preventDefault();

				$('.dropdown-selected').each(function (index, element) {
					console.log(element)
					var id = $(element).find("i").data("id");
					$('#mentor-select [value=' + id + ']').attr("selected", true);
					console.log(id);
				})

				this.submit();
			});

		});
	</script>
@endpush