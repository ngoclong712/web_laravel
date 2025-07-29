<form method="post" action="{{ route('process_login') }}">
    @csrf
    Email
    <input type="email" name="email">
    <br>
    Password
    <input type="password" name="password">
    <br>
    <button>Login</button>
    <br>
    <a href="{{ route('register') }}">Register</a>
</form>
