@include('header')
<div class="container">
    <center>
        <div class="col-md-4">
            <br><br><br><br>
            @if(session('notification'))
            <div class="alert alert-danger alert-dismisable">
                <a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>
                <strong>{{ session('notification') }}</strong>
            </div>
            @endif
            <h3 align=”middle”>Login</h3>
            <form action="{{ url('login') }}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="login" class="col-sm-2 col-form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span style="color: red">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                    <span style="color: red">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
            </form>
        </div>
    </center>
</div>
</body>
</html>