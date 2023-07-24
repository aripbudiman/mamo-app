@if (Session::has('success'))
<script>
    Swal.fire(
        'Berhasil',
        `{{Session::get('success')}}`,
        'success'
    )

</script>
@endif
