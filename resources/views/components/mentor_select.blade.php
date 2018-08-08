<select id="{{ $id }}" class="d-none" name="mentors[]" multiple>
</select>

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#{{ $parentId }}').dropdown({
				multipleMode: 'label',
				input: '<input type="text" maxLength="100" placeholder="@lang("placeholders.search")">',
				data: [
					{!! $slot !!}
				],
				searchable: true,
			});
		});
	</script>
@endpush