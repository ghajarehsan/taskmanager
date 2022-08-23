<form method="post" action="{{route('file.upload')}}" enctype="multipart/form-data">
    @csrf
    <input type="checkbox" name="is_private">
    <input type="text" name="name"/>
    <input type="file" name="file">
    <input type="submit">
    {{dd($errors->messages())}}
</form>
