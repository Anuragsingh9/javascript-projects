<html lang="">
<head>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Laravel</title>
</head>
<body>
<div class="centred">
    <form method="post" action=" {{route('upload')}}" enctype="multipart/form-data">
        <div class="form">
            {{ csrf_field() }}
            <input type="file" name="file" placeholder="Enter the photo">
            <button>Upload</button>
        </div>
    </form>
    <h3><?php  $message = $message ?? '';
        echo $message;
            ?></h3>
</div>
</body>
</html>
