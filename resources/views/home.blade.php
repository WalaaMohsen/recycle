<!DOCTYPE html>
<html>
<head>
    <style>
        button{
            border: none;
            width: 60px;
            height: 30px;
            background-color: green;
            text-align: center;
            margin: 20px 20px;
            float: right;
        }
        a{
            color: white;
            margin: 5px 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;">Welcom Home</h1>
<button><a href="{{route('getregister')}}">Rgister</a></button>
<button><a href="{{route('getlogin')}}">Login</a></button>
</body>
</html>