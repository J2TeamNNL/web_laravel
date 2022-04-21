<form method="post" action="{{ route('process_register') }}">
    @csrf
    Name
    <input type="name" name="name">
    <br>
    Email
    <input type="email" name="email">
    <br>
    Password
    <input type="password" name="password">
    <br>
    <button>
        Register
    </button>
</form>