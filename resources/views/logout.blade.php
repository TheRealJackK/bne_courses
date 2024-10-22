<h3 id="logout" style="display: none;">Logout</h3>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <fieldset>
        <legend>Logout:</legend>
        <label>Press the button to Logout</label>
        <input type="submit" id="submit" value="Logout"></input>
    </fieldset>
</form>
