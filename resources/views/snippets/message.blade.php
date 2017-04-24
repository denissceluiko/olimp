@if(session()->has('msg'))
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 alert alert-success">{{ session()->get('msg') }}</div>
    </div>
</div>
@endif