<form action="{{ route('register.store') }}" method="POST">
  @csrf
  <input type="text" name="name" id="name">
  <input type="text" name="email" id="email">
  <input type="text" name="password" id="password">
  <button type="submit">submit</button>
</form>