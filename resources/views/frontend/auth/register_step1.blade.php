<form action="{{ route('register.step1.post') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <button type="submit">Next</button>
</form>


<form action="{{ route('register.step2.post') }}" method="POST">
    @csrf
    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>


<h1>Registration Complete!</h1>
<p>Thank you for registering.</p>


