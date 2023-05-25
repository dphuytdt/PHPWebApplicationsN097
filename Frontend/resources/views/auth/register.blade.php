<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <title>Registation</title>
    <link rel="stylesheet" href="{{asset('css/auth/register.css')}}" type="text/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container">
        <div class="title">Registation</div>
        <form action="{{ route('postRegister') }}" method="POST">
            @csrf
            <div class="user_details">
                <div class="input_pox">
                    <span class="datails">Full Name</span>
                    <input type="text" placeholder="enter your name" required>
                </div>
                <div class="input_pox">
                    <span class="datails">Username</span>
                    <input type="text" placeholder="enter your Username" required>
                </div>
                <div class="input_pox">
                    <span class="datails">Email</span>
                    <input type="text" placeholder="enter your Email" required>
                </div>
                <div class="input_pox">
                    <span class="datails">Phone Number</span>
                    <input type="text" placeholder="enter your Phone" required>
                </div>
                <div class="input_pox">
                    <span class="datails">Password</span>
                    <input type="text" placeholder="enter your Password" required>
                </div>
                <div class="input_pox">
                    <span class="datails">Confirm Password</span>
                    <input type="text" placeholder="Confirm your Password" required>
                </div>
            </div>
            <div class="gender_details">
                <input type="radio" name="gender" id="dot-1">
                <input type="radio" name="gender" id="dot-2">
                <input type="radio" name="gender" id="dot-3">
                <span class="gender_title"> Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Mail</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Femail</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Perer not to say</span>
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
            <div class="link">Already have an account? <a href="{{ route('login') }}">Login here</a></div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
</body>
</html>