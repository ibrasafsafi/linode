@extends('layouts.app')

@section('content')
    <livewire:list-instances />
@endsection

{{--
@section('scripts')
    <script>
        $('.btn-delete').on('click', function () {
            const linodeId = $(this).attr('linode-id');

            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: `/instances/${linodeId}`,
                type: 'DELETE',
                success: function (response) {
                    console.log('Deleted')
                }
            });
        });

        $('.btn-reboot').on('click', function () {
            const linodeId = $(this).attr('linode-id');

            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: `/instances/${linodeId}/reboot`,
                type: 'POST',
                success: function (response) {
                    console.log('REBOOTING')
                }
            });
        });
    </script>
@endsection
--}}
